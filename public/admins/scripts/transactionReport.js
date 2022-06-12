function laporanTransaksiComponent(pendapatan, terjual) {
    return `<div class="print-title">
                <h4 style="text-align: center">LAPORAN TRANSAKSI</h4>
                <h4 style="text-align: center">${$('#search-month').val()}</h4>
            </div>
            <br><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Pemesan</th>
                        <th>Tanggal</th>
                        <th>Unit</th>
                        <th>Harga</th>
                        <th>Ongkir</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody id="semua-transaksi-data">
                    
                </tbody>
            </table>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="metric" style="height: 99px">
                        <span class="icon"><i class="fas fa-boxes"></i></span>
                        <p>
                            <span class="number" style="margin-bottom: .5rem" id="unit-terjual">${terjual}</span>
                            <span class="title" style="font-size: 1.4rem;">Unit Terjual</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="metric" style="height: 99px">
                        <span class="icon"><i class="fas fa-sack-dollar"></i></span>
                        <p>
                            <span class="number" style="margin-bottom: .5rem" id="total-pendapatan">${pendapatan}</span>
                            <span class="title" style="font-size: 1.4rem;">Total Pendapatan</span>
                        </p>
                    </div>
                </div>
            </div>`
}

function laporanTransaksiDataComponent(params) {
    let tBody = ``
    $.each(params, function(i, v){
        tBody = tBody + `<tr style="background: rgb(250, 250, 250)">
                            <td>${v.nama}</td>
                            <td>${v.tanggal}</td>
                            <td>${v.jumlah_unit}</td>
                            <td>${v.harga}</td>
                            <td>${v.ongkir}</td>
                            <td>${v.total}</td>
                        </tr>`
    })

    return tBody
}

$('#btn-search-report').on('click', function(){
    if ($('#search-month').val().length == 0) {
        alert('Masukkan periode transaksi')
    }else{
        $('#laporan-transaksi-content').html(`<div class="loader">
                                                <div class="loader4"></div>
                                                <h5 style="margin-top: 2.5rem">Loading data</h5>
                                            </div>`)
        $('#btn-print').hide()
        
        ajaxRequest.post({
            "url": "/admin/laporan-transaksi/get",
            "data": {
                "periode": $('#search-month').val()
            }
        }).then(function(result){
            if (result.transaksi.length > 0) {
                $('#btn-print').show()
                $('#laporan-transaksi-content').html(laporanTransaksiComponent(result.pendapatan, result.terjual))
                $('#semua-transaksi-data').html(laporanTransaksiDataComponent(result.transaksi))
            }else{
                $('#btn-print').hide()
                $('#laporan-transaksi-content').html(`<div class="loader">
                                                            <i class="fas fa-ban" style="font-size: 5rem; opacity: .5"></i>
                                                            <h5 style="margin-top: 2.5rem; opacity: .75">Belum ada transaksi di bulan ini</h5>
                                                        </div>`)
            }
        })
    }
})

$('#btn-print').on('click', function () {
    $('body').addClass('layout-fullwidth')
    $('.print-title').show()
    window.print()
    setTimeout(() => {
        $('body').removeClass('layout-fullwidth')
        $('.print-title').hide()
    }, 1);
})