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
	<div class="col-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Destek Talebi Oluştur</h4>
				<div id="SupportCreateAlert" class="mt-3"></div>
				<form class="forms-sample mt-4" action="" onsubmit="return false;">
					<div class="form-group">
						<label for="title">Başlık</label>
						<input type="text" class="form-control" id="title" placeholder="Başlık Giriniz.">
					</div>
					<div class="form-group">
						<label for="content">Mesaj</label>
						<textarea class="form-control" id="content" rows="6"></textarea>
					</div>
					<button onclick="SupportCreate();" id="SupportCreateBtn" type="submit" style="margin-left: 36%" class="btn btn-gradient-success mr-2">Oluştur</button>
					<button onclick="SupportAlertHide();" type="reset" class="btn btn-gradient-danger">İptal</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require VMDIR.'/Template/footer.php'; ?>