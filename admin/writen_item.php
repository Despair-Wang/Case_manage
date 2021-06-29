 <div class="row">
     <div class="col-12 col-md-8 offset-md-2 d-flex align-self-center">
         <!-- block-1 -->
         <div class="row info_block">
             <div class="col-12" style="text-align: end;">
                 <p style="font-size: 0.9rem;">有*號者為必填項目</p>
             </div>
             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>頭像</h5>
                     </div>
                     <div class="col-8">
                         <div class="d-flex align-items-center justify-content-center h-100">
                             <label class="btn case_ctrl w_auto mb-0">
                                 <input type="file" style="display: none" id="up_img" name="file" accept="image/*" />
                                 <i class="fa fa-photo"></i>&emsp;上傳圖片
                             </label>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-12">
                 <div id="newImg"></div>
             </div>

             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>姓名</h5><sup>*</sup>
                     </div>
                     <div class="col-8">
                         <h5><input class="w-100" id="name" name="name" type="text" required></h5>
                     </div>
                 </div>
             </div>
             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>性別</h5>
                     </div>
                     <div class="col-8">
                         <h5><input id="sex_m" name="sex" type="radio" value="M">
                             <label for="sex_m">男&emsp;</label>
                             <input id="sex_f" name="sex" type="radio" value="F">
                             <label for="sex_f">女&emsp;</label>
                             <input id="sex_etc" name="sex" type="radio" value="ETC">
                             <label for="sex_etc">其他</label>
                         </h5>
                     </div>
                 </div>
             </div>
             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>暱稱</h5>
                     </div>
                     <div class="col-8">
                         <h5><input class="w-100" id="nickname" name="nickname" type="text"></h5>
                     </div>
                 </div>
             </div>
             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>密碼</h5><sup>*</sup>
                     </div>
                     <div class="col-8">
                         <h5><input class="w-100" id="pw" name="pw" type="password"></h5>
                         <span class="show_pw"><i class="fa fa-eye"></i></span>
                     </div>
                 </div>
             </div>
             <div class="col-12 mb-3 oper_only">
                 <div class="row">
                     <div class="col-4">
                         <h5>身分</h5>
                     </div>
                     <div class="col-8">
                         <h5>
                             <select name="identity" id="identity">
                                 <option value="">請選擇身分</option>
                                 <option value="直屬社員">直屬社員</option>
                                 <option value="合作兼職">合作兼職</option>
                             </select>
                         </h5>
                     </div>
                 </div>
             </div>
             <div class="col-12 mb-3 oper_only">
                 <div class="row">
                     <div class="col-4">
                         <h5>使用車種</h5>
                     </div>
                     <div class="col-8">
                         <h5>
                             <select name="car_type" id="car_type">
                                 <option value="">請選擇車種</option>
                                 <option value="小客車">小客車</option>
                                 <option value="大客車">大客車</option>
                                 <option value="箱型車">箱型車</option>
                                 <option value="遊覽車">遊覽車</option>
                                 <option value="社內配給車">社內配給車</option>
                             </select>
                         </h5>
                     </div>
                 </div>
             </div>
             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>電子郵件</h5><sup>*</sup>
                     </div>
                     <div class="col-8">
                         <h5><input autocomplete="off" class="w-100" id="mail" name="mail" type="text"></h5>
                     </div>
                 </div>
             </div>

             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>電話</h5>
                     </div>
                     <div class="col-8">
                         <h5><input class="w-100" id="tel" type="text" name="tel" type="tel"></h5>
                     </div>
                 </div>
             </div>
             <?php

if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    echo <<<admin_only
             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>備註</h5>
                     </div>
                     <div class="col-8">
                         <h5>
                             <textarea name="remark" id="remark" cols="30" rows="1"></textarea>
                         </h5>
                     </div>
                 </div>
             </div>

             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>帳號類型</h5>
                     </div>
                     <div class="col-8">
                         <h5>
                             <select name="role_select" id="role_select">
                                 <option value="user">使用者</option>
                                 <option value="operator">幹員</option>
                                 <option value="admin">管理員</option>
                             </select>
                         </h5>
                     </div>
                 </div>
             </div>

             <div class="col-12 mb-3">
                 <div class="row">
                     <div class="col-4">
                         <h5>帳號狀態</h5>
                     </div>
                     <div class="col-8">
                         <h5>
                             <select name="enable" id="enable">
                                 <option value="0">凍結</option>
                                 <option value="1">啟用</option>
                             </select>
                         </h5>
                     </div>
                 </div>
             </div>
             admin_only;
}
?>
         </div>
         <!-- control-button -->
     </div>
 </div>