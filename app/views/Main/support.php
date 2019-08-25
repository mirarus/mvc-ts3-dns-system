<?php
/*
	Mirarus MVC Dns System for everyone
	Copyright (C) 2019 by Mirarus

	This program is free software
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
		
	for help look https://mirarus.com/mvc-ts3-dns-system
*/
?>
<?php require VMDIR.'/Template/header.php'; ?>
<div class="row">
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Destek Taleplerim</h4>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Başlık</th>
								<th>Durum</th>
								<th>Tarih</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($Support_Data_F as $Support_Data_R) { ?>
								<tr>
									<td><?php echo $Support_Data_R['id']; ?></td>
									<td><?php echo $Support_Data_R['title']; ?></td>
									<td>
										<?php if($Support_Data_R['status'] == '1'){
											echo '<label class="badge badge-gradient-info">Cevap Bekliyor</label>';
										} elseif($Support_Data_R['status'] == '2'){
											echo '<label class="badge badge-gradient-success">Cevaplandı</label>';
										} elseif($Support_Data_R['status'] == '3'){
											echo '<label class="badge badge-gradient-warning">Müşteri Yanıtı</label>';
										} elseif($Support_Data_R['status'] == '4'){
											echo '<label class="badge badge-gradient-danger">Kapalı</label>';
										} ?>
									</td>
									<td><?php echo date('d.m.Y H:i:s', $Support_Data_R['time']); ?></td>
									<td>
										<a href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/support/<?php echo $Support_Data_R['id']; ?>'">
											<label class="badge badge-gradient-info">Görüntüle</label>
										</a>
									</td>
									<?php if ($Support_Data_R['status'] != '4') { ?>
										<td>
											<a href="#" onclick="SupportClose('<?php echo SITE_URL; ?>', <?php echo $Support_Data_R['id']; ?>);">
												<label class="badge badge-gradient-danger">Kapat</label>
											</a>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require VMDIR.'/Template/footer.php'; ?>