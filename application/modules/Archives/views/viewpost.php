<div class="nav">
<ul class="select"><li><a href="<?php echo site_url('post');?>"><b>Add Post</b></a></li>
<li><a href="<?php echo site_url('post/viewPost');?>"><b>View Post</b></a></li>
</ul>
</div>
<table border="0" width="" cellpadding="0" cellspacing="0" id="product-table">
<tr>
<th class="table-header-repeat line-left minwidth-1"><a href="">Title</a></th>
<th class="table-header-repeat line-left minwidth-1"><a href="">catagories</a></th>
<th class="table-header-repeat line-left minwidth-1"><a href="">Feature Image</a></th>
<th class="table-header-repeat line-left"><a href="">Date</a></th>
<th class="table-header-options line-left"><a href="">Action</a></th>
</tr>
<?php
$count = count($user);
for($i = 0;$i< $count;$i++)
{?>
<tr style="border:1px solid black">
<td style="border:1px solid black"><?php echo $user[$i]['title'];?></td>
<td style="border:1px solid black"><?php echo $user[$i]['catagories'];?></td>
<td style="border:1px solid black">
<?php
$image = $user[$i]['featureImage'];
$explode = explode(',',$image);
?>
<img src="<?php echo base_url('upload');?>/<?php echo $explode[0]; ?>" height="80px" width="80px"></td>
<td style="border:1px solid black"><?php echo $user[$i]['saved_at'];?></td>
<td style="border:1px solid black"><a href="<?php echo site_url('post/editPost');?>/<?php echo $user[$i]['_id'];?>">Edit</a>
<a href="<?php echo site_url('post/deletePost');?>/<?php echo $user[$i]['_id'];?>">Delete</a></td>
</tr>
<?php } ?>
</table>

