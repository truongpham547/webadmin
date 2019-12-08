<div class="card-footer">
<form action="index.php" method="GET">
        <div class="row" align="center">
          <div class="col-sm-6 col-lg-3">
            <h6>Hiện các bài đăng từ...</h6>
            <div>
              <select class="primary" id="date" name="date" style="width:150px">
                <option value="0">Hôm nay</option>
                <option value="7">Tuần này</option>
                <option value="30">Tháng này</option>
                <option value="365">Năm nay</option>
                <option value="9999" selected="selected">Không</option>
            </select>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <h6>Sắp xếp bài đăng theo</h6>
            <div>
              <select class="primary" id="sort" name="sort" style="width:150px">
                <option value="newpost" selected="selected">Mới nhất</option>
                <option value="oldpost">Lâu nhất</option>
                <option value="views" >Lượt đánh giá</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <h6>Từ khóa</h6>
            <div>
              <span class="textboxcontainer"><span><input name="search" id="keyword" size="30" type="text" placeholder="Tìm Kiếm..." class="textbox" tabindex="99"> </span></span>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <button class="btn btn-success px-4" type="submit" style="margin-top:16px; width:80px">OK</button>
            <button class="btn btn-primary px-4" type="button" style="margin-top:16px; width:80px">Add</button>
          </div>
        </div>    
  </form>
</div>

<div class="card">
    <table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th class="text-center">Username</th>
                <th class="text-center">Ngày đăng</th>
                <th class="text-center">Tiêu đề</th>
                <th class="text-center">Nội dung</th>
                <th class="text-center">Địa chỉ</th>
                <th class="text-center">
                    <i class="icon-picture"></i>
                </th>
                <th class="text-center">Ratting</th>
                <th class="text-center">Chỉnh sửa</th>              
            </tr>
        </thead>
        <tbody>
            <?php while ($row=mysqli_fetch_assoc($data)){ 

              ?>
            <tr>
                    <td>
                    <strong><?php echo $row['id'] ?></strong>
                    </td>
                    <td  class="text-center" width="80">
                        <div><?php echo $row['username'] ?></div>
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#Profile<?php echo $row['username']?>">Profile</button>
                        <?php include 'profileuser.php' ?>
                    </td>
                    <td class="text-center" width="100">
                        <div><?php echo $row['ngaydang'] ?></div>
                    </td>
                    <td class="text-center" width="100">
                        <div><?php echo $row['tieude'] ?></div>
                    </td>
                    <td>
                        <div><?php echo $row['noidung'] ?></div>
                    </td>
                    <td>
                        <div><?php echo $row['diachi'] ?></div>
                    </td>
                    <td>
                        <img src="android/hinhanh/<?php echo $row['hinhanh'] ?>" style="width:150px;height:100px;" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                    </td>
                    <td class="text-center">
                        <div><?php echo $row['rating'] ?></div>
                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#DetailRating<?php echo $row['id'] ?>">Detail</button>
                        <?php include 'detailrating.php' ?>
                    </td>
                    <td class="text-center" width="100">
                        <button type="button" class="btn btn-danger" style="margin-top:20px" data-toggle="modal" data-target="#ConfirmDel">Del</button>
                            <div class="modal fade" id="ConfirmDel" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Bạn có muốn xóa bài viết này?</h4>
                                        </div>
                                        <div class="modal-body">
                                          <a href="delreview.php?id=<?php echo $row['id'] ?>" class="btn btn-danger" role="button" aria-pressed="true" style="margin:10px">Yes</a>
                                          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                      
                                </div>
                            </div>
                    </td>
            </tr>
                <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  