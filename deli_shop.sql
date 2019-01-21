SELECT tb_transaksi.invoice, nm_transaksi, DATE(tnggl) AS tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) 
AS nama_pegawai, (SELECT item FROM tb_barang WHERE id=id_item ) AS item, qty, discount, total_price, statuss, tb_deposit.method 
AS method FROM tb_transaksi INNER JOIN tb_deposit ON tb_deposit.invoice=tb_transaksi.invoice 