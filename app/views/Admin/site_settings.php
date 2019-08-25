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
                <h4 class="card-title">Site Bilgilerini Düzenle</h4>
                <p class="card-description"> Aşağıdaki Bölgelere Bilgilerinizi Girerek Kolayca Site Ayarlarını Düzenleyebilirsiniz. </p>
                <div id="SiteSettingsEditAlert"></div>
                <form class="forms-sample mt-5" action="" onsubmit="return false;">
                    <div class="form-group">
                        <label for="title">Site Başlık - Site Title <font color="red">*</font></label>
                        <input type="text" class="form-control" id="title" placeholder="Site Başlık Giriniz." value="<?php echo $Site_Control['title']; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Site Açıklaması - Site Description <font color="red">*</font></label>
                                <input type="text" class="form-control" id="description" placeholder="Site Açıklaması Giriniz." value="<?php echo $Site_Control['description']; ?>">
                            </div>
                        </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="keywords">Site Anahtar Kelimeleri - Site Keywords <font color="red">*</font></label>
                                <input type="text" class="form-control" id="keywords" placeholder="Site Anahtar Kelimeleri Giriniz." value="<?php echo $Site_Control['keywords']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="footer">Site Alt Bilgi - Site Footer <font color="red">*</font></label>
                        <textarea rows="4" class="form-control" id="footer" placeholder="Site Alt Bilgi Giriniz."><?php echo $Site_Control['footer']; ?></textarea>
                    </div>
                    <button onclick="SiteSettingsEdit(<?php echo $Site_Control['id']; ?>);" id="SiteSettingsEditBtn" type="submit" style="margin-left: 36%" class="btn btn-gradient-success mr-2">Düzenle</button>
                    <button onclick="SiteSettingsAlertHide();" type="reset" class="btn btn-gradient-danger">İptal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require VADIR.'/Template/footer.php'; ?>