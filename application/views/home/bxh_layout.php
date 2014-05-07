<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
  <!-- General headers -->
  <title></title>
  <base target="_blank">
  <!-- Reset all CSS styles -->
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css">

  <!-- Stylesheet template -->
  <script id="stylesheet" type="text/css">* {
  font: ${font_body_style} normal ${font_body_weight} ${font_body_size}pt/100% ${font_body_family};
  text-transform: ${font_body_transform};
  text-decoration: ${font_body_decoration};
  color: #${color_text};
}
#widget {
  background-color: #${color_background};
}
#box {
  position: relative;
  width: ${width}px;
  height: ${height}px;
}
#header {
}
#title {
  display: block;
  font: ${font_title_style} normal ${font_title_weight} ${font_title_size}pt/100% ${font_title_family};
  text-transform: ${font_title_transform};
  text-decoration: ${font_title_decoration};
  color: #${color_title};
  padding: 2px;
  padding-left: 24px;
  margin-bottom: 2px;
  background-repeat: no-repeat;
  background-position: 4px 50%;
}
#tabstrip {
  display: none;
  overflow: hidden;
  padding: 4px;
  padding-bottom: 0px;
  overflow: hidden;
}
.tabstrip #tabstrip {
  display: block;
}
#tabstrip A {
  display: inline-block;
  font: ${font_tab_style} normal ${font_tab_weight} ${font_tab_size}pt/100% ${font_tab_family};
  text-transform: ${font_tab_transform};
  text-decoration: ${font_tab_decoration};
  background-color: #${color_shadow};
  border: 1px solid #${color_button};
  border-bottom-width: 0px;
  padding: 4px;
  margin-right: 4px;
  overflow: hidden;
}
#tabstrip A.selected, #tabstrip A.selected:hover {
  color: #${color_buttontext};
  background-color: #${color_button};
  border-color: #${color_button};
  font-weight: bold;
  cursor: default;
}
#tabstrip A:hover {
  background-color: #${color_background};
  border-color: #${color_highlight};
}
#tabset {
  display: block;
  position: relative;
  overflow: hidden;
}
.tabstrip #tabset {
  border-top: 1px solid #${color_button};
  border-bottom: 1px solid #${color_button};
}
#tabset .tab {
  display: block;
  left: 0px;
  top: 0px;
  height: 0px;
  overflow: hidden;
}
#tabset .tab.selected {
  height: 100%;
}
#tabset .tab.scrollable {
  overflow: auto;
  overflow-x: hidden;
}
A {
  color: inherit;
  font-weight: inherit;
}
.hide {
  display: none !important;
}

/** Branding **/
#poweredby {
  float: right;
  display: inline-block;
  font: normal normal normal 8pt/100% serif;
  text-decoration: none;
  padding: 2px 20px 2px 0px;
  margin-top: 4px;
  height: 12px;
  background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAB3RJTUUH2gsaDjgpaLYangAAAAlwSFlzAAALEwAACxMBAJqcGAAAAARnQU1BAACxjwv8YQUAAAAwUExURf9mAP/Mqv/////gzP+ZVf+FM//17v9wEf+td//r3f+4iP/Wu/96Iv/Cmf+jZv+PRLWEUqcAAABCSURBVHjaY2AgCQhpBiUIc6ow8CkbNZkqfzJgYFHaEySbfOkBA0OwZpBY80wGBjYNzaAsTw0GBkYlk6B0p3TSLAAAatAMMFag0OYAAAAASUVORK5CYII=) no-repeat right 50%;
}
#poweredby:hover {
  text-decoration: underline;
}
#banner A {
  color: #${color_text};
}

/** General table styling **/
TABLE {
  width: ${width}px;
  border-collapse: collapse;
}
TH {
  font-weight: bold;
  border-bottom: 1px solid #${color_button};
}
TH, TD {
  padding: 3px 4px;
  white-space: nowrap;
  width: 3ex;
}
TR.odd TD {
  background-color: #${color_shadow};
}
TR.hover TD {
  color: #${color_buttontext};
  background-color: #${color_button};
  cursor: pointer;
}
.scrollable .last {
  padding-right: 20px;
}

/** League table styling **/
#table TH, #table TD {
  text-align: center;
  width: 3ex;
}
#table .rank {
  width: 2ex;
  font-size: 80%;
  text-align: center;
}
#table .team {
  width: auto;
  overflow: hidden;
  text-align: left;
}
#table .highlight .team * {
  font-weight: bold;
}
#table .goals_for {
  padding-left: 2ex;
}
#table .points {
  padding-left: 2ex;
  font-weight: bold;
}
#table .goal_difference.negative {
  color: #${color_highlight};
  font-weight: bold;
}
#table .hover A {
  text-decoration: underline;
}

/** Results/fixtures styles */
.matches .weekday {
  width: 4ex;
  font-size: 80%;
  text-align: right;
}
.matches .weekday * {
  font-size: inherit;
}
.matches .date {
  width: 8ex;
}
.matches .duplicate-date .weekday .timestamp, .matches .duplicate-date .date .timestamp {
  display: none;
}
.matches .team-a {
  width: auto;
  text-align: right;
  padding-right: 1ex;
}
.matches .team-b {
  width: auto;
  padding-left: 1ex;
}
.matches TD.highlight {
  font-weight: bold;
}
.matches .result, .matches .time {
  width: 8ex;
  background-color: #${color_background};
  border-left: 1px solid #${color_button};
  border-right: 1px solid #${color_button};
  text-align: center;
  font-weight: bold;
}
.matches .hover .result, .matches .hover .time {
  color: #${color_text};
  background-color: #${color_shadow};
}</script>

  <!-- Hide widget until stylesheet is loaded -->
  

  <!-- External script resources -->
  <script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>

  <script src="<?php echo base_url();?>template/ezwebvietnam/home_sgfs/media/js/date_format.js"></script>
  <script type="text/javascript" charset="utf-8">
    /* <![CDATA[ */
    dateFormat.i18n = {
      dayNames: ["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
      monthNames: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","January","February","March","April","May","June","July","August","September","October","November","December"]
    };
    /* ]]> */
  </script>
  <script src="<?php echo base_url();?>template/ezwebvietnam/home_sgfs/media/js/timestamp_formatter.js"></script>

  <!-- Main script -->
  <script type="text/javascript">
  	var config = {"widget":"competition","parameters":{"competition_id":8,"baseteam_id":662},"features":{"table":{"":true,"colmp":true,"colmw":true,"colmd":true,"colml":true,"colgf":true,"colga":true,"colgd":false},"results":{"":true},"fixtures":{"":true},"weekdays":{"":false},"scroll":{"":true}},"width":"350","height":"300","colors":{"background":"FFFFFF","text":"000000","title":"F85F00","shadow":"E8E8E8","button":"C0C0C0","buttontext":"000000","highlight":"FF0000"},"fonts":{"body":{"family":"Tahoma,sans-serif","size":9,"style":"normal","weight":"normal","decoration":"none","transform":"none"},"title":{"family":"Impact,sans-serif","size":13,"style":"normal","weight":"normal","decoration":"none","transform":"none"},"tab":{"family":"Tahoma,sans-serif","size":9,"style":"normal","weight":"normal","decoration":"none","transform":"none"}}};

  	// Configuration interface
  	config.isPremium = function() { return false; };
  	config.showAds = function() { return true; };
  	config.featureEnabled = function(feature, subfeature) {
  		if (!this.features[feature] || !this.features[feature]['']) return false;
  		if (!subfeature || this.features[feature][subfeature]) return true;
  		return false;
  	}
  	config.setDimensions = function(width, height) { this.width = parseInt(width); this.height = parseInt(height); };
  	config.setColor = function(name, value) { if (this.colors[name] && /^[0-9a-f]{6}$/i.test(value)) this.colors[name] = value; };
  	config.setFontAttribute = function(name, value) {
  		var parts = name.split('_'), name = parts[0], attr = parts[1];
  		if (this.fonts[name] && this.fonts[name][attr] && !/[;}<>]/.test(value)) this.fonts[name][attr] = value;
  	};
  	config.featuresToTags = function(features) {
  		var tags = [];
  		for (feature in features) {
  			if (!features[feature]) continue;
  			tags.push(feature);
  			for (subfeature in features[feature])
  				if (features[feature][subfeature])
  					tags.push(feature + '_' + subfeature);
  		}
  		tags.sort();
  		return tags;
  	};
  	config.disableAllFeatures = function() {
  		for (feature in this.features) {
  			for (subfeature in this.features[feature])
  				this.features[feature][subfeature] = false;
  		}
  	};
  	config.setFeatures = function(value) {
  		var oldFeatures = this.featuresToTags(this.features);
  		var tags = value.split(',');
  		this.disableAllFeatures();
  		for (i in tags) {
  			var tag = tags[i].toString(), parts = tag.split('_', 2), feature = parts[0], subfeature = parts[1];
  			if (!this.features[feature]) continue;
  			if (subfeature && this.features[feature][subfeature] == undefined) continue;
  			if (!subfeature) subfeature = '';
  			this.features[feature][subfeature] = true;
  		}
  		if (oldFeatures.join() != this.featuresToTags(this.features).join()) {
  			return true;
  		} else {
  			return false;
  		}
  	};

  	// Template parser
  	String.prototype.parseTemplate = function(variables) {
  		var pattern = /\$\{\w+\}/ig, textParts = this.split(pattern), tags = this.match(pattern), output = [textParts[0]];
  		if (!tags) return this;
  		for (var i = 0; i < tags.length; i++) output.push(variables[tags[i].slice(2,-1)], textParts[i+1]);
  		return output.join('');
  	}

  	// Array.contains method
  	Array.prototype.contains = function(item) { for (var i in this) if (this[i] == item) return true; return false; }

  	// Key=value list parser
  	String.prototype.parseKeyValue = function() {
  		var EOS = String.fromCharCode(0), text = this + EOS, result = {}, name = '', value = '', state = 0, c;
  		for (var i = 0; i < text.length; i++)	switch (c = text.charAt(i)) {
  			case '=': if (state == 0) state = 1; else value += c; break;
  			case '&': if (state == 0) { name += c; break; }
  			case EOS: if (state == 1) { result[name] = value; name = value = ''; state = 0; } break;
  			default:  if (state == 0) name +=c; else value += c;
  		}
  		return result;
  	};

  	// Loads custom settings from the hash part of the URI
  	// TODO: block this functionality for premium widgets when not previewing
  	var oldHash;
  	function loadHashConfig() {
  		if (oldHash == location.hash) return false;

  		// Parse hash
  		var values = location.hash.slice(1).parseKeyValue();

  		// Process values
  		var features_changed = false;
  		for (name in values) switch (name.charAt(0)) {
  			case 'c': config.setColor(name.slice(1), values[name]); break;
  			case 't': config.setFontAttribute(name.slice(1), values[name]); break;
  			case 'f': if(typeof convertFeatures == 'function') { values[name] = convertFeatures(values[name]); } if (config.setFeatures(values[name])) features_changed = true; break;
  			case 'd': var parts = values[name].split('x'); config.setDimensions(parts[0], parts[1]); break;
  		}

  		// Signal that features were changed
  		if (features_changed) $(document).trigger('featureschanged', config);

  		// Done
  		oldHash = location.hash;
  		return true;
  	}

  	// Loads the stylesheet based on the current configuration
  	function applyStylesheet() {
  		// Build template variables list
  		var variables = {};
  		for (color in config.colors) variables['color_' + color] = config.colors[color];
  		for (font in config.fonts) for (attribute in config.fonts[font]) variables['font_' + font + '_' + attribute] = config.fonts[font][attribute];
  		variables.width = config.width;
  		variables.height = config.height  - 20 ;

  		// Trigger event to allow widget to add more template variables
  		$(document).trigger('cssrender', variables);

  		// Generate stylesheet
  		var css = $('#stylesheet').get(0).text.parseTemplate(variables);

  		// Remove old stylesheet
  		$('HEAD STYLE').remove();

  		// Create new Stylesheet
  		var stylesheet = document.createStyleSheet ? document.createStyleSheet() : document.createElement('STYLE');
  		stylesheet.cssText = stylesheet.innerHTML = css;

  		// Add new stylesheet
  		$('HEAD').append(stylesheet);

  		// Apply size constraints
  		$('#widget').width(config.width).height(config.height).trigger('resize');

  		// Trigger event
  		$(document).trigger('cssrendered', variables);
  	}

  	$(function() {
  		// Load settings from hash
  		loadHashConfig();

  		// Run widget script
  		try {
  			// Helper functions
function setVisibility(element, visible) { addClassIf(element, !visible, 'hide'); }
function addClassIf(element, condition, cssClass) { var $e = $(element); if (condition) $e.addClass(cssClass); else $e.removeClass(cssClass); }

//Function to simulate anchor tag click
function simulateAnchorClick(anchor) {
  // Create form on the fly
  $anchor = $(anchor);
  $form = $('<form/>').attr({
  	'action': $anchor.attr('href'),
  	'method': 'post',
  	'target': $anchor.attr('target')});
  $(document.body).append($form);
  $form.submit().remove();
}

// Initialization code
(function() {
  //Activate tab switching
  $('#tabstrip>A').click(function() {
  	$('#tabstrip A,#tabset .tab').removeClass('selected');
  	$($(this).addClass('selected').attr('href')).addClass('selected');
  	return false;
  });

  // Add row hover effect and click
  $('TR').hover(function() {
  	$(this).addClass('hover');
  }, function() {
  	$(this).removeClass('hover');
  }).click(function(event) {
  	if (event.target.tagName == 'A') return;
  	event.stop();
  	simulateAnchorClick($(this).find('A:first'));
  });

  // Hide duplicate weekdays/dates
  $('.matches TABLE').each(function() {
  	$table = $(this);
  	var last_date = null;
  	$table.find('TBODY TR').each(function() {
  		$row = $(this);
  		date = $row.find('.date').text();
  		if (date == last_date)
  			// Register row as having duplicate date
  			$row.addClass('duplicate-date');
  		last_date = date;
  	});
  });
})();

// Hook into events
$(document)

// Handle feature selection
.bind('featureschanged', function(event, config) {
  // See whether to display the title
  var show_title = config.featureEnabled('title') || !config.isPremium();
  setVisibility($('#title'), show_title);

  // See what tabs to display
  var show_table = config.featureEnabled('table');
  var show_results = config.featureEnabled('results');
  var show_fixtures = config.featureEnabled('fixtures');

  // Hide unwanted tabs
  setVisibility($('#tabstrip A[href="#table"],#table'), show_table);
  setVisibility($('#tabstrip A[href="#results"],#results'), show_results);
  setVisibility($('#tabstrip A[href="#fixtures"],#fixtures'), show_fixtures);

  //Select first tab page (important to do this before possibly hiding tab strip)
  $('#tabstrip .selected, #tabset .tab.selected').removeClass('selected');
  $($('#tabstrip A:not(.hide):first').addClass('selected').attr('href')).addClass('selected');

  // Hide tab strip if only one tab is visible (in premium mode only)
  addClassIf($('#box'), $('#tabstrip A:not(.hide)').length > 1 || config.showAds(), 'tabstrip');

  //Hide match columns (if features are disabled)
  setVisibility($('#table').find('.matches-played'), config.featureEnabled('table', 'colmp'));
  setVisibility($('#table').find('.wins'), config.featureEnabled('table', 'colmw'));
  setVisibility($('#table').find('.losses'), config.featureEnabled('table', 'colml'));
  setVisibility($('#table').find('.draws'), config.featureEnabled('table', 'colmd'));

  // Hide goal columns (if features are disabled)
  setVisibility($('#table').find('.goals_for'), config.featureEnabled('table', 'colgf'));
  setVisibility($('#table').find('.goals_against'), config.featureEnabled('table', 'colga'));
  setVisibility($('#table').find('.goal_difference'), config.featureEnabled('table', 'colgd'));

  // Hide weekday columns if feature disabled
  setVisibility($('.weekday'), config.featureEnabled('weekdays'));

  // Scroll feature
  addClassIf($('.tab'), config.featureEnabled('scroll'), 'scrollable');
})

// Event fired before stylesheet template is rendered
.bind('cssrender', function(event, variables) {
})

// Event fired after stylesheet rendering
.bind('cssrendered', function(event, variables) {
  // CSS has been rendered. Determine correct height of tabset
  var header_height = $('#header').outerHeight() + 0;
  var height = variables.height - header_height - 1;
  $('#tabset').height(height);

  // Make all rows visible by default
  $('TBODY TR').removeClass('hide');

  if (config.featureEnabled('scroll')) {
  	// Set TBODY height to allow scrolling
  	$('.tab TABLE.scrollable').each(function() {
  		var $table = $(this);
  		var head_height = $table.find('THEAD').height();
  		var $tbody = $table.find('TBODY');
  		var extra_height = $tbody.outerHeight() - $tbody.innerHeight();
  		$tbody.height(height - head_height - extra_height);
  	});
  } else {
  	// League table
  	var $table = $('#table TABLE');
  	var $tbody = $table.find('TBODY');
  	var rows = $tbody.find('TR').length;
  	while ($table.height() > height && rows > 0) {
  		if (!$tbody.children('TR:not(.hide):not(:lt(3),:gt(' + (rows - 4) + '),.highlight):last').addClass('hide').length)
  			// No more rows left to hide
  			break;
  		rows--;
  	}

  	// Results/fixtures tables
  	$('.matches TABLE').each(function() {
  		var $table = $(this);
  		var $tbody = $table.find('TBODY');
  		var rows = $tbody.find('TR').length;
  		var visibleRows = Math.floor(height / $table.height() * rows);
  		$tbody.children('TR').slice(visibleRows).addClass('hide');
  	});
  }

  // Assign odd classes
  $('.tab TBODY').each(function() {
  	$(this).find('TR').removeClass('odd').filter(':not(.hide):odd').addClass('odd');
  });
})

  		} catch (e) {
  			// TODO: better error handling
  			alert(e);
  		}

  		// Apply feature set
  		$(document).trigger('featureschanged', config);

  		// Load stylesheet
  		applyStylesheet();

  		// Monitor URL hash changes
  		var oldHash = location.hash;
  		window.setInterval(function() { if (loadHashConfig()) applyStylesheet(); }, 500);
  	});
  </script>

<style>* {
  font: normal normal normal 9pt/100% Tahoma,sans-serif;
  text-transform: none;
  text-decoration: none;
  color: #000000;
}
#widget {
  background-color: #FFFFFF;
}
#box {
  position: relative;
  width: 263px;
  height: 267px;
}
#header {
}
#title {
  display: block;
  font: normal normal normal 13pt/100% Impact,sans-serif;
  text-transform: none;
  text-decoration: none;
  color: #F85F00;
  padding: 2px;
  padding-left: 24px;
  margin-bottom: 2px;
  background-repeat: no-repeat;
  background-position: 4px 50%;
}
#tabstrip {
  display: none;
  overflow: hidden;
  padding: 4px;
  padding-bottom: 0px;
  overflow: hidden;
}
.tabstrip #tabstrip {
  display: block;
}
#tabstrip A {
  display: inline-block;
  font: normal normal normal 9pt/100% Tahoma,sans-serif;
  text-transform: none;
  text-decoration: none;
  background-color: #E8E8E8;
  border: 1px solid #C0C0C0;
  border-bottom-width: 0px;
  padding: 4px;
  margin-right: 4px;
  overflow: hidden;
}
#tabstrip A.selected, #tabstrip A.selected:hover {
  color: #000000;
  background-color: #C0C0C0;
  border-color: #C0C0C0;
  font-weight: bold;
  cursor: default;
}
#tabstrip A:hover {
  background-color: #FFFFFF;
  border-color: #FF0000;
}
#tabset {
  display: block;
  position: relative;
  overflow: hidden;
}
.tabstrip #tabset {
  border-top: 1px solid #C0C0C0;
  border-bottom: 1px solid #C0C0C0;
}
#tabset .tab {
  display: block;
  left: 0px;
  top: 0px;
  height: 0px;
  overflow: hidden;
}
#tabset .tab.selected {
  height: 100%;
}
#tabset .tab.scrollable {
  overflow: auto;
  overflow-x: hidden;
}
A {
  color: inherit;
  font-weight: inherit;
}
.hide {
  display: none !important;
}

/** Branding **/
#poweredby {
  float: right;
  display: inline-block;
  font: normal normal normal 8pt/100% serif;
  text-decoration: none;
  padding: 2px 20px 2px 0px;
  margin-top: 4px;
  height: 12px;
  background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQBAMAAADt3eJSAAAAB3RJTUUH2gsaDjgpaLYangAAAAlwSFlzAAALEwAACxMBAJqcGAAAAARnQU1BAACxjwv8YQUAAAAwUExURf9mAP/Mqv/////gzP+ZVf+FM//17v9wEf+td//r3f+4iP/Wu/96Iv/Cmf+jZv+PRLWEUqcAAABCSURBVHjaY2AgCQhpBiUIc6ow8CkbNZkqfzJgYFHaEySbfOkBA0OwZpBY80wGBjYNzaAsTw0GBkYlk6B0p3TSLAAAatAMMFag0OYAAAAASUVORK5CYII=) no-repeat right 50%;
}
#poweredby:hover {
  text-decoration: underline;
}
#banner A {
  color: #000000;
}

/** General table styling **/
TABLE {
  width: 263px;
  border-collapse: collapse;
}
TH {
  font-weight: bold;
  border-bottom: 1px solid #C0C0C0;
}
TH, TD {
  padding: 3px 4px;
  white-space: nowrap;
  width: 3ex;
}
TR.odd TD {
  background-color: #E8E8E8;
}
TR.hover TD {
  color: #000000;
  background-color: #C0C0C0;
  cursor: pointer;
}
.scrollable .last {
  padding-right: 20px;
}

/** League table styling **/
#table TH, #table TD {
  text-align: center;
  width: 3ex;
}
#table .rank {
  width: 2ex;
  font-size: 80%;
  text-align: center;
}
#table .team {
  width: auto;
  overflow: hidden;
  text-align: left;
}
#table .highlight .team * {
  font-weight: bold;
}
#table .goals_for {
  padding-left: 2ex;
}
#table .points {
  padding-left: 2ex;
  font-weight: bold;
}
#table .goal_difference.negative {
  color: #FF0000;
  font-weight: bold;
}
#table .hover A {
  text-decoration: underline;
}

/** Results/fixtures styles */
.matches .weekday {
  width: 4ex;
  font-size: 80%;
  text-align: right;
}
.matches .weekday * {
  font-size: inherit;
}
.matches .date {
  width: 8ex;
}
.matches .duplicate-date .weekday .timestamp, .matches .duplicate-date .date .timestamp {
  display: none;
}
.matches .team-a {
  width: auto;
  text-align: right;
  padding-right: 1ex;
}
.matches .team-b {
  width: auto;
  padding-left: 1ex;
}
.matches TD.highlight {
  font-weight: bold;
}
.matches .result, .matches .time {
  width: 8ex;
  background-color: #FFFFFF;
  border-left: 1px solid #C0C0C0;
  border-right: 1px solid #C0C0C0;
  text-align: center;
  font-weight: bold;
}
.matches .hover .result, .matches .hover .time {
  color: #000000;
  background-color: #E8E8E8;
}</style></head>

<body marginwidth="0" marginheight="0">
  <div id="widget" style="display: block; overflow: hidden; width: 263px; height: 287px;">
  	<div id="box" class="tabstrip">

  <div id="header">
  	<a id="title" href="http://www.soccerway.com/national/england/premier-league/20132014/" style="background-image: url(http://widgets.soccerway.com/media/img/flags/16x16/plain/england.png)">
  		England - Premier League
  	</a>

  	<a id="poweredby" href="http://widgets.soccerway.com" title="Powered by Soccerway.com">Powered by</a>
  	<div id="tabstrip"><a href="#table" class="selected">League table</a><a href="#results" class="hide">Results</a><a href="#fixtures" class="hide">Fixtures</a></div>
  </div>

  <div id="tabset" style="height: 218px;">
  	<div id="table" class="tab selected scrollable">
  		<table>
  			<thead><tr class="">
  				<th class="rank first" title="Rank">#</th>
  				<th class="team" title="Team">Team</th>

  				<th class="matches-played" title="Matches played">MP</th>
  				<th class="wins hide" title="Wins">W</th>
  				<th class="draws hide" title="Draws">D</th>
  				<th class="losses hide" title="Losses">L</th>
  				<th class="goals_for hide" title="Goals for">F</th>
  				<th class="goals_against hide" title="Goals against">A</th>
  				<th class="goal_difference hide" title="Goal difference">D</th>
  				<th class="points last" title="Points">P</th>
  			</tr></thead>

  			<tbody>
  				<tr class="first">
  					<td class="rank first">1</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/liverpool-fc/" title="Liverpool">Liverpool</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">25</td>
  					<td class="draws hide">6</td>
  					<td class="losses hide">6</td>
  					<td class="goals_for hide">99</td>
  					<td class="goals_against hide">49</td>
  					<td class="goal_difference positive hide">+50</td>
  					<td class="points last">81</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">2</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/manchester-city-football-club/" title="Manchester City">Manchester City</a></td>

  					<td class="matches-played">36</td>
  					<td class="wins hide">25</td>
  					<td class="draws hide">5</td>
  					<td class="losses hide">6</td>
  					<td class="goals_for hide">96</td>
  					<td class="goals_against hide">37</td>
  					<td class="goal_difference positive hide">+59</td>
  					<td class="points last">80</td>
  				</tr>
  				<tr class="  ">
  					<td class="rank first">3</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/chelsea-football-club/" title="Chelsea">Chelsea</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">24</td>
  					<td class="draws hide">7</td>
  					<td class="losses hide">6</td>
  					<td class="goals_for hide">69</td>
  					<td class="goals_against hide">26</td>
  					<td class="goal_difference positive hide">+43</td>
  					<td class="points last">79</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">4</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/arsenal-fc/" title="Arsenal">Arsenal</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">23</td>
  					<td class="draws hide">7</td>
  					<td class="losses hide">7</td>
  					<td class="goals_for hide">66</td>
  					<td class="goals_against hide">41</td>
  					<td class="goal_difference positive hide">+25</td>
  					<td class="points last">76</td>
  				</tr>
  				<tr class="">
  					<td class="rank first">5</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/everton-football-club/" title="Everton">Everton</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">20</td>
  					<td class="draws hide">9</td>
  					<td class="losses hide">8</td>
  					<td class="goals_for hide">59</td>
  					<td class="goals_against hide">39</td>
  					<td class="goal_difference positive hide">+20</td>
  					<td class="points last">69</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">6</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/tottenham-hotspur-football-club/" title="Tottenham Hotspur">Tottenham Hotspur</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">20</td>
  					<td class="draws hide">6</td>
  					<td class="losses hide">11</td>
  					<td class="goals_for hide">52</td>
  					<td class="goals_against hide">51</td>
  					<td class="goal_difference positive hide">+1</td>
  					<td class="points last">66</td>
  				</tr>
  				<tr class="highlight">
  					<td class="rank first">7</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/manchester-united-fc/" title="Manchester United">Manchester United</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">19</td>
  					<td class="draws hide">6</td>
  					<td class="losses hide">12</td>
  					<td class="goals_for hide">63</td>
  					<td class="goals_against hide">42</td>
  					<td class="goal_difference positive hide">+21</td>
  					<td class="points last">63</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">8</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/southampton-fc/" title="Southampton">Southampton</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">15</td>
  					<td class="draws hide">10</td>
  					<td class="losses hide">12</td>
  					<td class="goals_for hide">53</td>
  					<td class="goals_against hide">45</td>
  					<td class="goal_difference positive hide">+8</td>
  					<td class="points last">55</td>
  				</tr>
  				<tr class="  ">
  					<td class="rank first">9</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/newcastle-united-football-club/" title="Newcastle United">Newcastle United</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">15</td>
  					<td class="draws hide">4</td>
  					<td class="losses hide">18</td>
  					<td class="goals_for hide">42</td>
  					<td class="goals_against hide">57</td>
  					<td class="goal_difference negative hide">-15</td>
  					<td class="points last">49</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">10</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/stoke-city-fc/" title="Stoke City">Stoke City</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">12</td>
  					<td class="draws hide">11</td>
  					<td class="losses hide">14</td>
  					<td class="goals_for hide">43</td>
  					<td class="goals_against hide">51</td>
  					<td class="goal_difference negative hide">-8</td>
  					<td class="points last">47</td>
  				</tr>
  				<tr class="">
  					<td class="rank first">11</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/crystal-palace-fc/" title="Crystal Palace">Crystal Palace</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">13</td>
  					<td class="draws hide">5</td>
  					<td class="losses hide">19</td>
  					<td class="goals_for hide">31</td>
  					<td class="goals_against hide">46</td>
  					<td class="goal_difference negative hide">-15</td>
  					<td class="points last">44</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">12</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/west-ham-united-fc/" title="West Ham United">West Ham United</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">11</td>
  					<td class="draws hide">7</td>
  					<td class="losses hide">19</td>
  					<td class="goals_for hide">40</td>
  					<td class="goals_against hide">49</td>
  					<td class="goal_difference negative hide">-9</td>
  					<td class="points last">40</td>
  				</tr>
  				<tr class="">
  					<td class="rank first">13</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/wales/swansea-city-afc/" title="Swansea City">Swansea City</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">10</td>
  					<td class="draws hide">9</td>
  					<td class="losses hide">18</td>
  					<td class="goals_for hide">51</td>
  					<td class="goals_against hide">53</td>
  					<td class="goal_difference negative hide">-2</td>
  					<td class="points last">39</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">14</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/aston-villa-football-club/" title="Aston Villa">Aston Villa</a></td>

  					<td class="matches-played">36</td>
  					<td class="wins hide">10</td>
  					<td class="draws hide">8</td>
  					<td class="losses hide">18</td>
  					<td class="goals_for hide">39</td>
  					<td class="goals_against hide">54</td>
  					<td class="goal_difference negative hide">-15</td>
  					<td class="points last">38</td>
  				</tr>
  				<tr class="">
  					<td class="rank first">15</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/hull-city-afc/" title="Hull City">Hull City</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">10</td>
  					<td class="draws hide">7</td>
  					<td class="losses hide">20</td>
  					<td class="goals_for hide">38</td>
  					<td class="goals_against hide">51</td>
  					<td class="goal_difference negative hide">-13</td>
  					<td class="points last">37</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">16</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/west-bromwich-albion-football-club/" title="West Bromwich Albion">West Bromwich …</a></td>

  					<td class="matches-played">36</td>
  					<td class="wins hide">7</td>
  					<td class="draws hide">15</td>
  					<td class="losses hide">14</td>
  					<td class="goals_for hide">42</td>
  					<td class="goals_against hide">55</td>
  					<td class="goal_difference negative hide">-13</td>
  					<td class="points last">36</td>
  				</tr>
  				<tr class="  ">
  					<td class="rank first">17</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/sunderland-association-football-club/" title="Sunderland">Sunderland</a></td>

  					<td class="matches-played">36</td>
  					<td class="wins hide">9</td>
  					<td class="draws hide">8</td>
  					<td class="losses hide">19</td>
  					<td class="goals_for hide">38</td>
  					<td class="goals_against hide">57</td>
  					<td class="goal_difference negative hide">-19</td>
  					<td class="points last">35</td>
  				</tr>
  				<tr class="odd">
  					<td class="rank first">18</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/norwich-city-fc/" title="Norwich City">Norwich City</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">8</td>
  					<td class="draws hide">9</td>
  					<td class="losses hide">20</td>
  					<td class="goals_for hide">28</td>
  					<td class="goals_against hide">60</td>
  					<td class="goal_difference negative hide">-32</td>
  					<td class="points last">33</td>
  				</tr>
  				<tr class="  ">
  					<td class="rank first">19</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/england/fulham-football-club/" title="Fulham">Fulham</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">9</td>
  					<td class="draws hide">4</td>
  					<td class="losses hide">24</td>
  					<td class="goals_for hide">38</td>
  					<td class="goals_against hide">83</td>
  					<td class="goal_difference negative hide">-45</td>
  					<td class="points last">31</td>
  				</tr>
  				<tr class="last odd">
  					<td class="rank first">20</td>
  					<td class="team"><a href="http://www.soccerway.com/teams/wales/cardiff-city-fc/" title="Cardiff City">Cardiff City</a></td>

  					<td class="matches-played">37</td>
  					<td class="wins hide">7</td>
  					<td class="draws hide">9</td>
  					<td class="losses hide">21</td>
  					<td class="goals_for hide">31</td>
  					<td class="goals_against hide">72</td>
  					<td class="goal_difference negative hide">-41</td>
  					<td class="points last">30</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>

  	<div id="results" class="tab matches hide scrollable">
  		<table>
  			<tbody>
  				<tr class="first  highlight">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399401900" data-format="ddd">Wed</span></td>
  					<td class="date"><span class="timestamp" data-value="1399401900" data-format="dd/mm/yy">07/05/14</span></td>
  					<td class="team-a highlight" title="Manchester United">Manchester United</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/06/england/premier-league/manchester-united-fc/hull-city-afc/1483791/">3 - 1</a></td>
  					<td class="team-b last " title="Hull City">Hull City</td>
  				</tr>
  				<tr class="odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399316400" data-format="ddd">Tue</span></td>
  					<td class="date"><span class="timestamp" data-value="1399316400" data-format="dd/mm/yy">06/05/14</span></td>
  					<td class="team-a " title="Crystal Palace">Crystal Palace</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/05/england/premier-league/crystal-palace-fc/liverpool-fc/1483820/">3 - 3</a></td>
  					<td class="team-b last " title="Liverpool">Liverpool</td>
  				</tr>
  				<tr class="  ">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399215600" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399215600" data-format="dd/mm/yy">04/05/14</span></td>
  					<td class="team-a " title="Chelsea">Chelsea</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/04/england/premier-league/chelsea-football-club/norwich-city-fc/1483819/">0 - 0</a></td>
  					<td class="team-b last " title="Norwich City">Norwich City</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399206600" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399206600" data-format="dd/mm/yy">04/05/14</span></td>
  					<td class="team-a " title="Arsenal">Arsenal</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/04/england/premier-league/arsenal-fc/west-bromwich-albion-football-club/1483817/">1 - 0</a></td>
  					<td class="team-b last " title="West Bromwich Albion">West Bromwich …</td>
  				</tr>
  				<tr class="  ">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399134600" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399134600" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a " title="Everton">Everton</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/everton-football-club/manchester-city-football-club/1483821/">2 - 3</a></td>
  					<td class="team-b last " title="Manchester City">Manchester City</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399125600" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399125600" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a " title="Aston Villa">Aston Villa</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/aston-villa-football-club/hull-city-afc/1483818/">3 - 1</a></td>
  					<td class="team-b last " title="Hull City">Hull City</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399125600" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399125600" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a " title="Newcastle United">Newcastle United</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/newcastle-united-football-club/cardiff-city-fc/1483823/">3 - 0</a></td>
  					<td class="team-b last " title="Cardiff City">Cardiff City</td>
  				</tr>
  				<tr class="highlight duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399125600" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399125600" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a highlight" title="Manchester United">Manchester United</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/manchester-united-fc/sunderland-association-football-club/1483822/">0 - 1</a></td>
  					<td class="team-b last " title="Sunderland">Sunderland</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399125600" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399125600" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a " title="Swansea City">Swansea City</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/swansea-city-afc/southampton-fc/1483825/">0 - 1</a></td>
  					<td class="team-b last " title="Southampton">Southampton</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399125600" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399125600" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a " title="Stoke City">Stoke City</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/stoke-city-fc/fulham-football-club/1483824/">4 - 1</a></td>
  					<td class="team-b last " title="Fulham">Fulham</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399117500" data-format="ddd">Sat</span></td>
  					<td class="date"><span class="timestamp" data-value="1399117500" data-format="dd/mm/yy">03/05/14</span></td>
  					<td class="team-a " title="West Ham United">West Ham United</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/05/03/england/premier-league/west-ham-united-fc/tottenham-hotspur-football-club/1483826/">2 - 0</a></td>
  					<td class="team-b last " title="Tottenham Hotspur">Tottenham Hotspur</td>
  				</tr>
  				<tr class="odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1398711600" data-format="ddd">Tue</span></td>
  					<td class="date"><span class="timestamp" data-value="1398711600" data-format="dd/mm/yy">29/04/14</span></td>
  					<td class="team-a " title="Arsenal">Arsenal</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/04/28/england/premier-league/arsenal-fc/newcastle-united-football-club/1483807/">3 - 0</a></td>
  					<td class="team-b last " title="Newcastle United">Newcastle United</td>
  				</tr>
  				<tr class="  ">
  					<td class="weekday first hide"><span class="timestamp" data-value="1398611400" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1398611400" data-format="dd/mm/yy">27/04/14</span></td>
  					<td class="team-a " title="Crystal Palace">Crystal Palace</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/04/27/england/premier-league/crystal-palace-fc/manchester-city-football-club/1483808/">0 - 2</a></td>
  					<td class="team-b last " title="Manchester City">Manchester City</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1398603900" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1398603900" data-format="dd/mm/yy">27/04/14</span></td>
  					<td class="team-a " title="Liverpool">Liverpool</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/04/27/england/premier-league/liverpool-fc/chelsea-football-club/1483810/">0 - 2</a></td>
  					<td class="team-b last " title="Chelsea">Chelsea</td>
  				</tr>
  				<tr class="last  duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1398596400" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1398596400" data-format="dd/mm/yy">27/04/14</span></td>
  					<td class="team-a " title="Sunderland">Sunderland</td>
  					<td class="result"><a href="http://www.soccerway.com/matches/2014/04/27/england/premier-league/sunderland-association-football-club/cardiff-city-fc/1483814/">4 - 0</a></td>
  					<td class="team-b last " title="Cardiff City">Cardiff City</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>

  	<div id="fixtures" class="tab matches hide scrollable">
  		<table>
  			<tbody>
  				<tr class="first">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399488300" data-format="ddd">Thu</span></td>
  					<td class="date"><span class="timestamp" data-value="1399488300" data-format="dd/mm/yy">08/05/14</span></td>
  					<td class="team-a " title="Sunderland">Sunderland</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/07/england/premier-league/sunderland-association-football-club/west-bromwich-albion-football-club/1483734/"><span class="timestamp" data-value="1399488300" data-format="HH : MM">01 : 45</span></a></td>
  					<td class="team-b last  title=" west="" bromwich="" albion""="">West Bromwich …</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399488300" data-format="ddd">Thu</span></td>
  					<td class="date"><span class="timestamp" data-value="1399488300" data-format="dd/mm/yy">08/05/14</span></td>
  					<td class="team-a " title="Manchester City">Manchester City</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/07/england/premier-league/manchester-city-football-club/aston-villa-football-club/1483742/"><span class="timestamp" data-value="1399488300" data-format="HH : MM">01 : 45</span></a></td>
  					<td class="team-b last  title=" aston="" villa""="">Aston Villa</td>
  				</tr>
  				<tr class="  ">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Sunderland">Sunderland</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/sunderland-association-football-club/swansea-city-afc/1483834/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" swansea="" city""="">Swansea City</td>
  				</tr>
  				<tr class="highlight duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Southampton">Southampton</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/southampton-fc/manchester-united-fc/1483833/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last highlight title=" manchester="" united""="">Manchester United</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Tottenham Hotspur">Tottenham Hotspur</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/tottenham-hotspur-football-club/aston-villa-football-club/1483835/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" aston="" villa""="">Aston Villa</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="West Bromwich Albion">West Bromwich …</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/west-bromwich-albion-football-club/stoke-city-fc/1483836/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" stoke="" city""="">Stoke City</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Norwich City">Norwich City</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/norwich-city-fc/arsenal-fc/1483832/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" arsenal""="">Arsenal</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Liverpool">Liverpool</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/liverpool-fc/newcastle-united-football-club/1483830/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" newcastle="" united""="">Newcastle United</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Cardiff City">Cardiff City</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/cardiff-city-fc/chelsea-football-club/1483827/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" chelsea""="">Chelsea</td>
  				</tr>
  				<tr class="duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Fulham">Fulham</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/fulham-football-club/crystal-palace-fc/1483828/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" crystal="" palace""="">Crystal Palace</td>
  				</tr>
  				<tr class="duplicate-date">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Hull City">Hull City</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/hull-city-afc/everton-football-club/1483829/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" everton""="">Everton</td>
  				</tr>
  				<tr class="last  duplicate-date odd">
  					<td class="weekday first hide"><span class="timestamp" data-value="1399816800" data-format="ddd">Sun</span></td>
  					<td class="date"><span class="timestamp" data-value="1399816800" data-format="dd/mm/yy">11/05/14</span></td>
  					<td class="team-a " title="Manchester City">Manchester City</td>
  					<td class="time"><a href="http://www.soccerway.com/matches/2014/05/11/england/premier-league/manchester-city-football-club/west-ham-united-fc/1483831/"><span class="timestamp" data-value="1399471200" data-format="HH : MM">21 : 00</span></a></td>
  					<td class="team-b last  title=" west="" ham="" united""="">West Ham United</td>
  				</tr>
  			</tbody>
  		</table>
  	</div>
  </div>
</div>
<script type="text/javascript">
  convertFeatures = function(values) {
    if(values.match(/table_matches/)) {
      values += ',table_colmp,table_colmw,table_colmd,table_colml';
    }
    if(values.match(/table_goals/)) {
      values += ',table_colgf,table_colga';
    }
    return values;
  }

  TimestampFormatter.format('results');
  TimestampFormatter.format('fixtures');
</script>
  </div>
</body></html>