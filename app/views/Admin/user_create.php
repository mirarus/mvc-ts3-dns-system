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
				<h4 class="card-title">Üye Oluştur</h4>
				<p class="card-description"> Aşağıdaki Bölgelere Bilgilerinizi Girerek Kolayca Üye Oluşturabilirsiniz. </p>
				<div id="UserCreateAlert"></div>
				<form class="forms-sample mt-5" action="" onsubmit="return false;">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="mail">Mail <font color="red">*</font></label>
								<input type="email" class="form-control" id="mail" placeholder="Üye Mail Adresini Giriniz.">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="password">Şifre <font color="red">*</font></label>
								<input type="password" class="form-control" id="password" placeholder="Üye Şifresini Giriniz.">
							</div>
						</div>
						<div class="col-md-2"></div>
					</div>
					<button onclick="UserCreate();" id="UserCreateBtn" type="submit" style="margin-left: 36%" class="btn btn-gradient-success mr-2">Oluştur</button>
					<button onclick="UserAlertHide();" type="reset" class="btn btn-gradient-danger">İptal</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require VADIR.'/Template/footer.php'; ?>