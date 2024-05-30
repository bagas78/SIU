<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<?php if ($kategori == 'pembelian' || $kategori == 'produksi_bahan'): ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Tanggal</td>
				<td>Nomor</td>
				<td>Kode</td>
				<td>Nama</td>
				<td>Berat</td>
				<td>Panjang</td>
				<td>Harga</td>
				<td>Total</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $v): ?>
				
				<tr>
					<td><?=date_format(date_create($v['tanggal']), 'd/m/Y')?></td>
					<td><?=$v['nomor']?></td>
					<td><?=$v['kode']?></td>
					<td><?=$v['nama']?></td>
					<td><?=$v['berat']?></td>
					<td><?=$v['panjang']?></td>
					<td><?=number_format($v['harga'])?></td>
					<td><?=number_format($v['total'])?></td>
				</tr>

			<?php endforeach ?>
		</tbody>
	</table>

<?php endif ?>

<?php if ($kategori == 'penjualan' || $kategori == 'produksi_produk'): ?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Tanggal</td>
				<td>Nomor</td>
				<td>Kode</td>
				<td>Nama</td>
				<td>Konversi</td>
				<td>Batang</td>
				<td>Panjang "text"</td>
				<td>Qty "text"</td>
				<td>Panjang "Mtr"</td>

				<?php if ($kategori == 'penjualan'): ?>

					<td>Harga</td>
					<td>Total</td>

				<?php endif ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $v): ?>
				
				<tr>
					<td><?=date_format(date_create($v['tanggal']), 'd/m/Y')?></td>
					<td><?=$v['nomor']?></td>
					<td><?=$v['kode']?></td>
					<td><?=$v['nama']?></td>
					<td><?=$v['konversi']?></td>
					<td><?=$v['batang']?></td>
					<td><?=$v['panjang_text']?></td>
					<td><?=$v['qty_text']?></td>
					<td><?=$v['panjang_mtr']?></td>

					<?php if ($kategori == 'penjualan'): ?>
						
						<td><?=number_format(str_replace(',', '', $v['harga']))?></td>
						<td><?=number_format(str_replace(',', '', $v['total']))?></td>

					<?php endif ?>

				</tr>

			<?php endforeach ?>
		</tbody>
	</table>

<?php endif ?>