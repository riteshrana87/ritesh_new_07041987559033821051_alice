<div class="nav">
<ul class="select"><li><a href="<?php echo site_url('post');?>"><b>Add Post</b></a></li>
<li><a href="<?php echo site_url('post/viewPost');?>"><b>View Post</b></a></li>
</ul>
</div>
<form method = "POST" action = "<?php echo site_url('post/updatePost');?>">
<table border="0" cellpadding="0" cellspacing="0" id="id-form">
<tr>
<th valign="top">Title:</th>
<td><input type="hidden" name="post_id" class="inp-form" value = "<?php echo $user[0]['_id'] ;?>"/>
<input type="text" name="post_title" class="inp-form" value = "<?php echo $user[0]['title'] ;?>"/>
</td>
<td></td>
</tr>
<tr>
<th valign="top">Description:</th>
<td><textarea rows="5" cols="20" class="form-textarea" name="post_desc" ><?php echo $user[0]['description'] ;?></textarea></td>
<td></td>
</tr>
<tr>
<th valign="top">catagories:</th>
<td><select name="post_catag">
<option value="<?php echo $user[0]['catagories'] ;?>"><?php echo $user[0]['catagories'] ;?></option>
<option value="Clothes">Clothes</option>
<option value="Sports">Sports</option>
</select></td>
<td></td>
</tr>
<tr>
<th>&nbsp;</th>
<td valign="top">
<input type="submit" value="Update" class="form-submit" />
</td>
<td></td>
</tr>
</table>
</form>

