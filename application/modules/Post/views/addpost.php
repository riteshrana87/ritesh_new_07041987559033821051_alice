<div class="nav">
<ul class="select"><li><a href="<?php echo site_url('post');?>"><b>Add Post</b></a></li>
<li><a href="<?php echo site_url('post/viewPost');?>"><b>View Post</b></a></li>
</ul>
</div>
<form method = "POST" action = "<?php echo site_url('post/addPostData');?>" enctype= 'multipart/form-data'>
<table border="0" cellpadding="0" cellspacing="0" id="id-form">
<tr>
<th valign="top">Title:</th>
<td><input type="text" name="post_title" class="inp-form" /></td>
<td></td>
</tr>
<tr>
<th valign="top">Description:</th>
<td><textarea rows="10" cols="40" class="form-textarea" name="post_desc"></textarea></td>
<td></td>
</tr>
<tr>
<th valign="top">catagories:</th>
<td><select name="post_catag">
<option>Select</option>
<option value = "Catagory1" >Catagory1</option>
<option value = "Catagory2" >Catagory2</option>
</select></td>
</tr>
<tr>
<tr>
<th valign="top">Add Image:</th>
<td> <input type="file" name="userfile[]" id="file" multiple></td>
</tr>
<tr>
<th>&nbsp;</th>
<td valign="top">
<input type="submit" value="submit" />
</td>
<td></td>
</tr>
</table>
</form>

