<?php 
	$backDir = '';
	if(file_exists($backDir."config.php")) {
		require_once($backDir."config.php"); 
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title>Project Oslo Alpha</title>
	<script src="<?php echo $backDir; ?>scripts/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/skin/light/">
	<script src="<?php echo $backDir; ?>scripts/smooth_scroll.js"></script>
	<script src="<?php echo $backDir; ?>scripts/modernizr-latest.js"></script>
	<script src="<?php echo $backDir; ?>scripts/jquery-scrollable.js"></script>
	<script src="<?php echo $backDir; ?>scripts/oslo-ui.js"></script>
</head>
<body name="tp">
<div id="app-container">
	<div id="action-bar">
		<div class="row">
			<div class="menu-title">
				<ul>
					<li><a onclick="showElement('#float-left-menu', 1)" class="action_icon ic_menu_white icons icon_medium"></a></li>
					<li><span class="title">Home</span></li>
				</ul>
			</div>
			<div class="actions">
				<ul>
					<li><a onclick="showDialogBox('version')" class="icons action_icon ic_info_white icon_medium"></a></li>
					<li><a class="icons action_icon ic_settings_white icon_medium"></a>
					<ul class="dropdownlist">
						<li><a onclick="showDialogBox('sample')">Show Dialog Box</a></li>
						<li><a onclick="showBottomSheet('sample')">Show Bottom Sheet</a></li>
						<li><a onclick="showSnackbar('sample')">Show Snackbar</a></li>
					</ul>
					</li>
				</ul>
			</div>
		</div>
		<div class="row second">
			<div class="navigation">
				<ul>
					<li><a href="">Component Tab 1</a></li>
					<li><a href="">Component Tab 2</a></li>
					<li><a href="">Component Tab 3</a></li>
					<li><a >More</a>
					<ul class="dropdownlist">
						<li><a onclick="showDialogBox('sample')">Show Dialog Box</a></li>
						<li><a onclick="showBottomSheet('sample')">Show Bottom Sheet</a></li>
						<li><a onclick="showSnackbar('sample')">Show Snackbar</a></li>
					</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="float-left-menu">
		<div class="wrapper">
			<div class="title"><a class="icons icon_medium" onclick="showElement('none')"></a>Main Menu</div>
			<ul>
				<li><a>Option 1</a>
				<ul>
					<li><a>Sub-option 1</a></li>
					<li><a>Sub-option 2</a></li>
					<li><a>Sub-option 3</a></li>
					<li><a>Sub-option 4</a></li>
				</ul></li>
				<li><a>Option 2</a>
				<ul>
					<li><a>Sub-option 1</a></li>
					<li><a>Sub-option 2</a></li>
					<li><a>Sub-option 3</a></li>
					<li><a>Sub-option 4</a></li>
				</ul></li>
				<li><a>Option 3</a>
				<ul>
					<li><a>Sub-option 1</a></li>
					<li><a>Sub-option 2</a></li>
					<li><a>Sub-option 3</a></li>
					<li><a>Sub-option 4</a></li>
				</ul></li>
				<li><a>Option 4</a>
				<ul>
					<li><a>Sub-option 1</a></li>
					<li><a>Sub-option 2</a></li>
					<li><a>Sub-option 3</a></li>
					<li><a>Sub-option 4</a></li>
				</ul></li>
			</ul>
		</div>
	</div>
	<div id="body-container">
		<div class="full cover">
			<div class="wrapper">
				<a class="logo"></a>
				<div class="text" style="text-align: center;"><br><br>
					A responsive web user interface framework based on Material Design<br><br>
					<ul class="button-container">
						<li><a onclick class="raised_button xlarge_button">Get Started</a></li>
					</ul>
				</div>
				<a onclick="showElement('#bottom-sheet')" class="float_button ic_plus_white icon_medium pos_bottom_right"></a>
			</div>
		</div>
		<div class="content">
			<div class="bg-cover"></div>
			<div class="title">
				<h1>Versions</h1>
			</div>
			<div class="wrapper">
				<div class="col-10">
					<div class="card column-count-2">
						<h4>v0.7.1 (July 15, 2015)</h4>
						<ul>
							<li><i>Added: </i>Tabs component</li>
						</ul>
						<h4>v0.6.10 (June 27, 2015)</h4>
						<ul>
							<li><i>Fixed: </i>Column inside cards when zoomed-in</li>
							<li><i>Added: </i>Ripple effect when raised and flat buttons are clicked</li>
							<li><i>Added: </i>Different raised button sizes</li>
							<li><i>Fixed: </i>Button container margin</li>
							<li><i>Added: </i>Snackbars</li>
							<li><i>Fixed: </i>Transition of action bar and bottom sheet</li>
							<li><i>Added: </i>Dismiss cards with animation to swipe left or right, or shrink</li>
							<li><i>Added: </i>Undo cards</li>
							<li><i>Added: </i>Quick action button will not hide when snackbar is shown (for mobile devices)</li>
							<li><i>Fixed: </i>Consecutive snackbars</li>
						</ul>
						<h4>v0.5.6 (June 26, 2015)</h4>
						<ul>
							<li><i>Fixed: </i>Column inside cards on mobile</li>
							<li><i>Fixed: </i>Background-color of raised buttons</li>
						</ul>
						<h4>v0.5.4 (June 26, 2015)</h4>
						<ul>
							<li><i>Added: </i>Column inside cards</li>
						</ul>
						<h4>v0.5.3 (June 26, 2015)</h4>
						<ul>
							<li><i>Added: </i>Zoom responsiveness. Try zooming in and out (For desktop browsers). This can also be turned off.
							<ul>
								<li>If screen width size is more than 1260px, the floating side menu will be fixed at the left side of the screen.</li>
								<li>Else it will be hidden and needed to click the menu icon on the action bar for the menu to appear</li>
							</ul></li>
							<li><i>Added: </i>Full screen cover</li>
							<li><i>Added: </i>Loading icon in dialog box and bottom sheet components</li>
						</ul>
						<h4>v0.4.4 (June 25, 2015)</h4>
						<ul>
							<li><i>Fixed: </i>Action bar when scrolling
							<ul>
								<li>Hide when scroll down <i>(For desktop only)</i></li>
								<li>Show when scroll up <i>(For desktop only)</i></li>
							</ul>
							</li>
							<li><i>Fixed: </i>Mobile responsiveness</li>
							<li><i>Added: </i>Lists</li>
							<li><i>Added: </i>Sliders</li>
						</ul>
						<h4>v0.3.6 (June 23, 2015)</h4>
						<ul>
							<li><i>Added: </i>Textfields</li>
							<li><i>Added: </i>Dropdown list</li>
							<li><i>Added: </i>Radiobutton</li>
							<li><i>Added: </i>Checkbox</li>
							<li><i>Added: </i>Flat icons</li>
							<li><i>Added: </i>Colored icons</li>
						</ul>
						<h4>v0.2.6 (June 22, 2015)</h4>
						<ul>
							<li><i>Added: </i>Quick action to go to top of the web page</li>
							<li><i>Added: </i>Quick action icons that can be place at any side of a card</li>
							<li><i>Added: </i>Covers can now add pictures</li>
							<li><i>Added: </i>Card breaking an edge</li>
							<li><i>Added: </i>Dialog box</li>
							<li><i>Added: </i>Bottom sheet</li>
						</ul>
						<h4>v0.1.15 (June 21, 2015)</h4>
						<ul>
							<li><i>Added: </i>Action bar</li>
							<li><i>Added: </i>Action bar icons with drop-down menu</li>
							<li><i>Added: </i>Floating side menu</li>
							<li><i>Added: </i>Sub-menus</li>
							<li><i>Added: </i> Mobile responsiveness</li>
							<li><i>Added: </i>Floating action button</li>
							<li><i>Added: </i>Wide cover with logo</li>
							<li><i>Added: </i>Content with columns:
								<ul>
								<li>6-4 column</li>
								<li>4-6 column</li>
								<li>7-3 column</li>
								<li>3-7 column</li>
								<li>5-5 column</li>
								<li>1 column</li>
								<li>Or any as long column size is equal to 10</li>
								<li>3-3-3 column</li>
								</ul>
							</li>
							<li><i>Added: </i>Float-type button</li>
							<li><i>Added: </i>Flat-type button</li>
							<li><i>Added: </i>Card content</li>
							<li><i>Added: </i>On-screen responsiveness</li>
							<li><i>Added: </i>Click and move though page (Just like a touchscreen except you use your cursor)</li>
							<li><i>Added: </i>Primary and secondary color option</li>
							<li><i>Added: </i>Minimum and maximum width option</li>
							<li><i>Added: </i>Smooth transitions</li>
						</ul>
						<h4>v0.1.0 (June 21, 2015)</h4>
						<ul>
							<li><i>Added: </i>Basic layout and structure</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="bg-cover" style="height: 500px; background-image: url(images/skin/oslo/bg/cover.jpg);"></div>
			<div class="title">
				<h1>Components and functions</h1>
			</div>
			<div class="wrapper">
				<div class="col-6">
					<div class="card">
						<ul class="list">
							<li class="title">
								<div></div>
								<div>Contacts</div>
								<div></div>
							</li>
							<li>
								<div class="icon"><span class="flat_icon_36 circle_icon trans_icon" style="background-image: url(profile.jpg);"></span></div>
								<div class="primary"><a><span>Juvar Abrera</span><span>Lorem ipsum dolor sit amet.</span></a></div>
								<div class="secondary">
									<ul class="button-container">
										<li><a class="flat_icon_20 ic_info_outline gray_icon"></a></li>
									</ul>
								</div>
							</li>
							<li>
								<div class="icon"><span class="flat_icon_36 circle_icon trans_icon" style="background-image: url(profile.jpg);"></span></div>
								<div class="primary"><a><span>Juvar Abrera</span><span>Lorem ipsum dolor sit amet.</span></a></div>
								<div class="secondary">
									<ul class="button-container">
										<li><a class="flat_icon_20 ic_info_outline gray_icon"></a></li>
									</ul>
								</div>
							</li>
							<li>
								<div class="icon"><span class="flat_icon_36 circle_icon trans_icon" style="background-image: url(profile.jpg);"></span></div>
								<div class="primary"><a><span>Juvar Abrera</span><span>Lorem ipsum dolor sit amet.</span></a></div>
								<div class="secondary">
									<ul class="button-container">
										<li><a class="flat_icon_20 ic_info_outline gray_icon"></a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
					<div class="card">
						<h4>Forms</h4>
						<ul class="form-container">
							<li>
								<div class="input-container">
									<label>Full name</label>
									<input type="text" class="weight-5" placeholder="First name">
									<input type="text" class="weight-5" placeholder="Last name">
								</div>
							</li>
							<li>
								<div class="input-container">
									<label>Country</label>
									<select class="weight-10">
										<option value="">Philippines</option>
									</select>
								</div>
							</li>
						</ul>
						<ul class="button-container right">
							<li><input type="submit"></li>
							<li><a onclick class="raised_button">Text</a></li>
						</ul>
					</div>
					<div class="card">
						<h4>Radio button and checkbox</h4>
						<ul class="form-container">
							<li>
								<div class="input-container">
									<label>Hobbies</label>
									<div class="weight-10">
										<label><input type="checkbox"><span></span>Basketball</label>
										<label><input type="checkbox"><span></span>Volleyball</label>
										<label><input type="checkbox"><span></span>Badminton</label>
										<label><input type="checkbox"><span></span>Table tennis</label>
										<label><input type="checkbox" disabled><span></span>Disabled</label>
									</div>
								</div>
							</li>
							<li>
								<div class="input-container">
									<label>Gender</label>
									<div class="weight-10">
										<label><input type="radio" name="gender"><span></span>Male</label>
										<label><input type="radio" name="gender" disabled><span></span>Female</label>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="card">
						<h4>Quick action on cards</h4>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, delectus cupiditate reiciendis ducimus eaque quae quisquam. Consequuntur dolorum expedita ratione, ad provident nam dolor explicabo asperiores sit quos rerum laborum, dicta in ullam, aspernatur possimus ipsam eligendi totam! Adipisci nihil rem amet incidunt itaque distinctio aliquid, obcaecati fugit molestiae dolorum.
						<a onclick="" class="float_button ic_settings_white icon_medium pos_bottom_right"></a>
					</div>
					<div class="card">
						<h4>Buttons</h4>
						Floating action button
						<ul class="button-container">
							<li><a class="float_button ic_settings_white icon_medium"></a></li>
							<li><a onclick="" class="float_button ic_settings_white icon_medium"></a></li>
						</ul><br>
						Raised button
						<ul class="button-container">
							<li><a class="raised_button">Disabled</a></li>
							<li><a onclick="" class="raised_button">Active</a></li>
						</ul><br>
						Flat button
						<ul class="button-container">
							<li><a class="flat_button">Disabled</a></li>
							<li><a onclick="" class="flat_button">Active</a></li>
						</ul>
					</div>
				</div>
				<div class="col-4">
					<div class="card" id="card-sample">
						<h4>Dismiss a card</h4>
						<p>You can dismiss a card with shrink effect, swipe left, or swipe right.</p>
						<ul class="button-container right">
							<li><a onclick="dismissCard('sample')" class="raised_button">Shrink</a></li>
							<li><a onclick="dismissCard('sample', 'swipe-left')" class="raised_button">Swipe left</a></li>
							<li><a onclick="dismissCard('sample', 'swipe-right')" class="raised_button">Swipe right</a></li>
						</ul>
					</div>
					<div class="card">
						<h4>Snackbars</h4>
						<p>Snackbars provide lightweight feedback about an operation by showing a brief message at the bottom of the screen. Snackbars can contain an action.</p>
						<ul class="button-container right">
							<li><a onclick="showSnackbar('sample');" class="raised_button">Show demo</a></li>
						</ul>
					</div>
					<div class="card">
						<h4>Sliders</h4>
						<input type="range" min="0" max="255" value="0">
						<input type="range" min="0" max="255" value="0">
						<input type="range" min="0" max="255" value="0">
					</div>
					<div class="card">
						<h4>Icon buttons</h4>
						Icon buttons can changed into any color in one icon. The default color of the icon is the primary color of the website.
						<ul class="button-container">
							<li><a class="icon_button ic_alarm_off_color"></a></li>
							<li><a href="" class="icon_button ic_alarm_off_color"></a></li>
							<li><a href="" class="icon_button ic_alarm_off_color" style="background-color: red;"></a></li>
							<li><a href="" class="icon_button ic_alarm_off_color" style="background-color: pink;"></a></li>
							<li><a href="" class="icon_button ic_alarm_off_color" style="background-color: aqua;"></a></li>
							<li><a href="" class="icon_button ic_alarm_off_color" style="background-color: brown;"></a></li>
						</ul>
					</div>
					<div class="card">
						<h4>Flat button with icons</h4>
						<ul class="button-container">
							<li><a class="flat_button"><span class="flat_icon ic_download_color"></span>Download</a></li>
							<li><a href="#icons" class="flat_button"><span class="flat_icon ic_settings_color"></span>See icons</a></li>
						</ul>
					</div>
					<div class="card">
						<h4>Bottom sheet</h4>
						A bottom sheet is a sheet of material that slides up from the bottom edge of the screen and presents a set of clear and simple actions.
						<ul class="button-container right">
							<li><a onclick="showBottomSheet('sample');" class="raised_button"><span></span>Show Demo</a></li>
						</ul>
					</div>
					<div class="card">
						<h4>Dialog Box</h4>
						Dialogs inform users about critical information, require users to make decisions, or encapsulate multiple tasks within a discrete process. Use dialogs sparingly because they are interruptive in nature. Their sudden appearance forces users to stop their current task and refocus on the dialog content. Not every choice, setting, or detail warrants interruption and prominence.
						<ul class="button-container right">
							<li><a onclick="showDialogBox('sample');" class="raised_button">Show Demo</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?php /*
		<div class="content" name="icons">
			<div class="bg-cover"></div>
			<div class="title">
				<h1>Icons</h1>
			</div>
			<div class="wrapper">
				<div class="col-10">
					<div class="card">
						<ul class="button-container">
							$directory = "images/skin/oslo/icons/";
							$end = "_color.png";
							if(file_exists($directory)) {
								foreach (glob($directory."*".$end) as $filename) {
									$icon = str_replace($directory, "", str_replace($end, "", $filename));
									$icon_name = str_replace("_", " ", str_replace("ic_", "", $icon));
									echo '<li><a onclick="" class="flat_button"><span class="flat_icon '.$icon.'_color"></span>'.$icon_name.'</a></li>';
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		*/?>
	</div>
	<div id="footer-container">
		<div class="wrapper">
			<div class="col">Oslo Project Beta. Copyright 2015.</div>
			<div class="col">Design by Juvar Abrera</div>
		</div>
	</div>



	<a href="#tp" id="goTop" class="float_button ic_arrow-up_white icon_medium"></a>
	<div id="blackTrans" onclick="showElement('none')"></div>
	<div id="bottom-sheet"><div class="loading"></div></div>
	<div id="dialog-box">
		<div class="wrapper">
			<center><div class="loading"></div></center>
		</div>
	</div>
	<div id="snackbar">
		<div class="wrapper">
		</div>
	</div>
</div>
<script src="<?php echo $backDir; ?>scripts/debiki-utterscroll.js"></script>
</body>
</html>