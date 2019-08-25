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
<?php require VADIR.'/Template/header.php'; ?>
<div class="row">
	<div class="col-12 grid-margin">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Adminler</h4>
				<div id="alert"></div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Kullanıcı Adı</th>
								<th>Tarih</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($Admin_Data_F as $Admin_Data_R) { ?>
								<tr>
									<td><?php echo $Admin_Data_R['id']; ?></td>
									<td><?php echo $Admin_Data_R['username']; ?></td>
									<td><?php echo date('d.m.Y H:i:s', $Admin_Data_R['time']); ?></td>
									<td>
										<a href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/admin/<?php echo $Admin_Data_R['id']; ?>'">
											<label class="badge badge-gradient-info">Düzenle</label>
										</a>
									</td>
									<td>
										<a href="#" onclick="AdminDelete('<?php echo SITE_URL; ?>', <?php echo $Admin_Data_R['id']; ?>);">
											<label class="badge badge-gradient-danger">Sil</label>
										</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require VADIR.'/Template/footer.php'; ?>