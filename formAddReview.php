<div class="modal fade" id="AddReview" role="dialog">
    <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm bài đăng mới</h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                    <strong>Thêm bài đăng</strong>
                </div>
                <form action="addreview.php" method="post" id="formadd">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="email-input">Tiêu đề</label>
                                <div class="col-md-9">
                                <input type="text" id="text-input" name="tieude" class="form-control" placeholder="Nhập tiêu đề cho bài viết">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="text-input">Địa chỉ</label>
                                <div class="col-md-9">
                                    <input type="text" id="text-input" name="diachi" class="form-control" placeholder="Nhập địa chỉ cho bài viết">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="textarea-input">Nội dung</label>
                                <div class="col-md-9">
                                    <textarea id="textarea-input" name="noidung" rows="9" class="form-control" placeholder="Nhập nội dung.."></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="file-input">Hình</label>
                                <div class="col-md-9">
                                    <input type="file" id="file-input" name="hinhanh">
                                </div>
                            </div>        
                            <div align="center"> 
                                <button class="btn btn-success px-4" type="button" id="btn_upload">Submit</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
                            </div>
                        </div>
                    </div>     
                </form>
            </div>
        </div>
    </div>
</div>
