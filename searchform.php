<form id='search' method='get' action='<?php echo $config->urls->root?>search/'>

	<h3>Blog Search</h3>

	<p>
	<label for='search_keywords'>Keywords</label>
	<input type='text' name='keys' id='search_keywords' value='<?php 
		if($input->whitelist->keywords) echo $sanitizer->entities($input->whitelist->keywords); ?>' />
	</p>

	<p>
	<label for='search_lang'>Language</label>
	<select id='search_lang' name='lang'>
		<option value="">- select -</option><?php
		// generate the city options, checking the whitelist to see if any are already selected
		foreach($pages->get("/lang/")->children() as $lang) {
			$selected = $lang->name == $input->whitelist->lang ? " selected='selected' " : ''; 
			echo "<option$selected value='{$lang->name}'>{$lang->title}</option>"; 
		}
		?>
	</select>
	</p>

	<p>
	<label for='search_blog'>Blog</label>
	<select id='search_blog' name='blog'>
		<option value="">- select -</option><?php
		// generate the city options, checking the whitelist to see if any are already selected
		foreach($pages->get("/blog/")->children() as $blog) {
			$selected = $blog->name == $input->whitelist->blog ? " selected='selected' " : ''; 
			echo "<option$selected value='{$blog->name}'>{$blog->title}</option>"; 
		}
		?>
	</select>
	</p>

	<p>
	<label for='search_cat'>Category</label>
	<select id='search_cat' name='cat'>
		<option value="">- select -</option><?php
		// generate the city options, checking the whitelist to see if any are already selected
		foreach($pages->get("/c/")->children() as $cat) {
			$selected = $cat->name == $session->cat ? " selected='selected' " : ''; 
			echo "<option$selected value='{$cat->name}'>{$cat->title}</option>"; 
		}
		?>
	</select>
	</p>

	<p>
	<label for='search_country'>Country</label>
	<select id='search_country' name='country'>
		<option value="">- select -</option><?php
		// generate the city options, checking the whitelist to see if any are already selected
		foreach($pages->get("/country/")->children() as $country) {
			$selected = $country->name == $session->country ? " selected='selected' " : ''; 
			echo "<option$selected value='{$country->name}'>{$country->title}</option>"; 
		}
		?>
	</select>
	</p>

	<p><button type='submit' id='search_submit' name='submit' value='1' onClick="return empty()">Search</button></p>

</form>
