<?php 
/**
* @about: The documentation of QDP
* 
* 
* PHP version 5.4
*
* @version          1.0 - 06/03/2016
* @package          This file is part of QDP - QUICK DEVELOPMENT PACKAGE - THE DATABASE FREE CMS
* @copyright        (C) 2016 Gyula Soós
* @license          This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* See LICENSE.txt for copyright notices and details.
*/


//siteRootFolder, and adminRootFolder already defined
defined('QDP') or die("Rerstricted access");
?>
<head>
<style>
#documentation{
    font-family: sans-serif;
    text-align: justify;
}
#documentation a{
    color: black;
}
#documentation p{
    padding-left: 50px;
    padding-right: 50px;
}
#documentation .content{
    line-height: 50%;
    font-size: 1.2em;
 }

#documentation .chapterHead{
    font-size: 1.5em;
}
#documentation .centerText{
    font-weight: bold;
    text-align: center;
}
#documentation ol li{
    margin-left: 75px;
    font-weight: bold;
    margin-right: 75px;
}

#documentation ul li{
    margin-left: 25px;
    font-style: italic;
    margin-right: 45px;
}

#documentation ul{
    margin: 15px;
}

#documentation img{
    border:1px solid black;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

</style>
</head>
<div id="documentation">
<h1><a id="_Toc446528708">User manual</a></h1>

<p>The QDP – Quick Development Package is an open source, database free content management system. It has been created as part of a university project, and it tries to solve the problem of slow development process of small websites.</p>

<p>Normally if a developer would have to create quick, small website to one of its clients, that would mean, that he either would have to create the whole site from scratch, or based one of his templates, or would have to use one of the popular content management systems available. </p>

<p>The problem from creating a site from scratch or using a previously created template, is that requires a lot of time and a lot of repetitive work for each website created. If in the finishing stages, a modification is required, adding an extra menu item for example, the developer might have to modify all of the sub-pages.</p>

<p>The content management systems are fast to deploy, and modifications are easily handled. In the same time, they have an abundance of features that are not or rarely used sometimes overcomplicating simple tasks. The downloadable components and plugins propose a security risk just as the popularity of these content management systems; if a flaw has been discovered in a particular content management system all websites using that version of CMS are exposed.</p>

<p>The QDP tries to answer these problems, by providing a small website engine, that doesn’t require a database to work, and it can be edited from the back-end. It has a template system, and supports article and menu creation.</p>

<br />

<p class="content chapterHead"><a href="#_Toc446528709">2 Installation</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528710">2.1 System requirements</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528711">2.2 Installation process</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528712">2.3 Reinstalling the QDP</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528713">2.4 Accessing the back-end</a></p>

<p class="content chapterHead"><a href="#_Toc446528714">3 Managing the navigation bar</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528715">3.1 Creating a new menu item</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528716">3.2 Editing a menu item</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528717">3.3 Deleting a menu item</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528718">3.4 Restrictions</a></p>

<p class="content chapterHead"><a href="#_Toc446528719">4 Article and content management</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528720">4.1 The article editor window</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528721">4.2 What you see is what you get – WYSWYG editor</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528722">4.3 Creating a new article</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528723">4.4 Editing an existing article</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528724">4.5 Deleting an article</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528725">4.6 Creating a contact form</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528726">4.7 Limitations</a></p>

<p class="content chapterHead"><a href="#_Toc446528727">5 Global settings</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528728">5.1 Site name</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528729">5.2 Site description</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528730">5.3 The year the site operates from</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528731">5.4 Set the time zone of the site</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528732">5.5 Template</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528733">5.6 The email address settings</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528734">5.7 Customise the 401, 403, 404 message</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528735">5.8 Site offline</a></p>

<p class="content chapterHead"><a href="#_Toc446528736">6 Admin settings</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528737">6.1 User manager</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528738">6.2 Admin related settings</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528739">6.3 Additional server information</a></p>

<p class="content chapterHead"><a href="#_Toc446528740">7 Other back-end features</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528741">7.1 Documentation</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528742">7.2 Logout</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528743">7.3 Preview</a></p>

<p class="content chapterHead"><a href="#_Toc446528744">8 Troubleshooting</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528745">8.1 Reset password</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528746">8.2 Reset all passwords</a></p>

<p class="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#_Toc446528747">8.3 Server errors 500</a></p>

<br />
<h1><a id="_Toc446528709">2 Installation</a></h1>

<p>To install a new copy of QDP, the whole GitHub repository has to be downloaded from the following link:</p>

<p class="centerText"><a href="https://github.com/soosgyul/QDP---Quick-Deploy-Package/archive/master.zip">https://github.com/soosgyul/QDP---Quick-Deploy-Package/archive/master.zip</a></p>

<p>The contents of the zip file have to be extracted and transferred to the webhost server. For detailed information on how to copy files to your server, please refer to the webhost’s documentation.</p>

<h2><a id="_Toc446528710">2.1 System requirements</a></h2>

<p>The QDP at this point requires an Apache server v2.2 or newer with PHP version of 5.4.17 or newer. In PHP the JSON parser has to be enabled. </p>

<p>The back-end also requires JavaScript to be enabled in the browser it is viewed on.</p>

<h2><a id="_Toc446528711">2.2 Installation process</a></h2>

<p>When the QDP files have been placed onto the server, the domain name of the site or the exact address has to be visited in a web browser. For compatibility issues, the Google Chrome browser is recommended, but any modern browser should work.</p>

<p class="centerText">www.example.com</p>

<p class="centerText">or</p>

<p class="centerText">www.example.com/subfolder</p>

<p>The installation process should be started at this point (Figure 1):</p>

<img src="/admin/adminContent/00.Home/img/image001.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 1</span>

<p>The following information needs to be entered at this point:</p>
<ul>
    <li>The name of the website</li>

    <li>The username of the first admin account</li>

    <li>The password of the admin account</li>
</ul>
<p>Any other site related settings can be found in the Global Settings tab, after the installation has finished.</p>

<p>It is possible to store the login details of the admin account on the server on different locations:</p>
<ul>
<li>The root of the admin folder – Not recommended, because it may be possible for an attacker to get the contents of the login details file. </li>
<ul>
<li>Only use this option if the admin folder will be removed after deployment and leaving login details on an unknown server is undesirable.</li>
</ul>
<li>Outside the <b>public_html</b> or <b>www</b> folder – This option is recommended since it provides extra protection, by not exposing the contents of the login details file, keeping it in a not publicly available location.</li>
</ul>
<p>When the <span style="font-style: italic;">“Save”</span> button has been pressed, the entered details are saved to the server and the installation file is deleted from the server preventing any possible attacker to create new login credentials for himself.</p>

<h2><a id="_Toc446528712">2.3 Reinstalling the QDP</a></h2>

<p>If an error has been made during installation that is preventing the access to the back-end, it is possible re-upload the <span style="font-style: italic;">“install.php”</span> file to the root directory of the site, and restarting the installation. This reinstall procedure can be used, if accidentally all users have been deleted, or wrong password has been entered. During reinstall any previously set global settings are reserved.</p>

<h2><a id="_Toc446528713">2.4 Accessing the back-end</a></h2>

<p>The back-end of a QDP site enables the administrator to manage the main navigation bar, the content of the site and various site settings. </p>

<p>The back-end can be reached by typing <span style="font-style: italic;">“/admin”</span> after the current domain name. For example:</p>

<p class="centerText">www.example.com -&gt; www.example.com/admin</p>

<p>At this point a login window appears, where the previously set up username and password should be entered. After a successful login the main interface of the back-end is presented to the user.</p>

<img src="/admin/adminContent/00.Home/img/image002.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 2</span>

<p>If login is unsuccessful a <span style="font-style: italic;">“HTTP Error 401 - Unauthorized: Access is denied due to invalid credentials”</span> error is displayed.</p>

<br />
<h1><a id="_Toc446528714">3 Managing the navigation bar</a></h1>

<p>The main navigation bar is offering all the main features of the front-end side of the site. The two items that are present on the navigation bar by default is the Home button and the Contact button. Additional menu elements can be later added by navigating to the <span style="font-style: italic;">“Menu Items”</span> tab in the back-end. (Figure 3)</p>

<img src="/admin/adminContent/00.Home/img/image003.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 3</span>

<p>The menu structure of a QDP site may be only 1 level deep: each menu element, may have one or more sub-items, but the sub-items cannot contain any additional sub-items.</p>

<h2><a id="_Toc446528715">3.1 Creating a new menu item</a></h2>

<p>To create a new menu item, the administrator first has to navigate, in the back-end to the <span style="font-style: italic;">“Menu Items”</span> tab. Then from the dropdown list it has to select the menu item, under which the new item should be created. If the new item is required to appear on the top level, the <span style="font-style: italic;">“/”</span> option has to be selected.</p>

<p>Following the selection of the parent item, the order number must be determined. The order number must be a double digit number between 01 and 99, inclusive.</p>

<p>If two or more items have the same order number, these items will be ordered alphabetically.</p>

<p>Finally, by entering the name of the new menu item, and by clicking the <span style="font-style: italic;">“Create new menu item”</span> button, the new menu item has been created.</p>

<h2><a id="_Toc446528716">3.2 Editing a menu item</a></h2>

<p>It may be required to edit a menu item, if the menu items have to be reordered, renamed, or it has to be transformed to a sub-item or to upgrade to a first level item.</p>

<p>To edit an existing menu item, the menu item to be edited has to be clicked on. As soon as the menu item is clicked on, the details of the item will be populated in the form, similarly when a new item is created. At this point any required changes can be made. By clicking the <span style="font-style: italic;">“Rename”</span> button, the menu item will be renamed.</p>

<h2><a id="_Toc446528717">3.3 Deleting a menu item</a></h2>

<p>It may be required to delete a menu item, if it is no longer required. </p>

<p>To delete a menu item, it has to be selected by clicking on it. The menu item details will be populated in the form. Then by clicking the <span style="font-style: italic;">“Delete”</span> button, the menu item will be removed.</p>

<p>A menu item cannot be deleted as long there are sub-items and/or articles associated to it. To delete such a menu item, first the articles have to be deleted, then the sub-items.</p>

<h2><a id="_Toc446528718">3.4 Restrictions</a></h2>

<p>For technical reasons, the <span style="font-style: italic;">“Home”</span> item in the menu strip, it must always have the name <span style="font-style: italic;">“Home”</span>, to have a properly functioning front page. </p>

<p>For the same technical reasons, the <span style="font-style: italic;">“Home”</span> item must have the order number of <span style="font-style: italic;">“00”</span>. </p>

<p>These limitations can be overridden by changing the source code of the QDP. </p>

<br />
<h1><a id="_Toc446528719">4 Article and content management</a></h1>

<p>The article management in the QDP is one of the most important feature; this is why the QDP is a content management system. Obviously it has some limitations compared to regular content management systems and their database structures. </p>

<p>QDP by default comes with two articles, one for the home page, and the second one, a special article, that will include the contact form.</p>

<p>Each menu item, can contain 100 articles, but this may be increased by modifying the source code, allowing the site owner to have theoretically unlimited number of articles on each page. </p>

<p>In the release version of the QDP, the current articles, that are in the page, are listed in one single list view, organised first by the menu category, then the order number, then the title and finally by the date. In each row the edit and a delete pictograms are enabling the administrator to interact with each article. To create a new article, the <span style="font-style: italic;">“New Article”</span> button has to be pressed.</p>

<img src="/admin/adminContent/00.Home/img/image004.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 4</span>

<h2><a id="_Toc446528720">4.1 The article editor window</a></h2>

<img src="/admin/adminContent/00.Home/img/image005.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 5</span>

<p>When either the <span style="font-style: italic;">“New Article”</span> button or the edit button next to an article is pressed the article editor window will show. (Figure 5)</p>

<p>This article editor window contains a form with all the required fields for an article. These fields in order are:</p>
<ul>
<li>Menu</li>
<ul>
<li>It can be selected the article under which menu item should be displayed. If the required menu item is not present, then the menu item has to be created firts as described in the <span style="font-style: italic;">“Creating a new menu item”</span> section.</li>
</ul>
<li>Order Number</li>
<ul>
<li>The order number should be a double digit number between 00 and 99, inclusive. If the order number is left blank, its default value will be saved: <span style="font-style: italic;">“00”</span>.</li>
</ul>
<li>Title</li>
<ul>
<li>The title of the article will be saved as the filename of the JSON file on the server (together with the order number) and the article title that will be displayed on the front-end of the site. It is required that every article has a title, but by unchecking the <span style="font-style: italic;">“Title enabled”</span> checkbox, it can be disabled to be shown on the site.</li>
</ul>
<li>Subtitle</li>
<ul>
<li>The subtitle, if completed will be displayed after the main title. It is not required to be completed and it can be disabled.</li>
</ul>
<li>Date</li>
<ul>
<li>The date, if completed will be displayed after the subtitle. It is required to be completed but it can be disabled.</li>
</ul>
<li>Article</li>
<ul>
<li>All the text and elements present in the article textbox will be displayed in the main body of the article.</li>
</ul>
<li>Cancel</li>
<ul>
<li>By pressing the <span style="font-style: italic;">“Cancel”</span> button, all modifications will be discarded and the article window will close.</li>
</ul>
<li>Save</li>
<ul>
<li>By pressing the <span style="font-style: italic;">“Save”</span> button, all modifications and contents of the fields will be saved.</li>
</ul>
</ul>
<h2><a id="_Toc446528721">4.2 What you see is what you get – WYSWYG editor</a></h2>

<p>The built in <span style="font-style: italic;">“WYSWYG”</span> editor in QDP is the TinyMCE. It’s built in features are more than enough to create a fully customised article. It is possible to include videos or images from the internet via links or embed codes. Image upload and management is also supported. If required the source of the article can be viewed in a raw format, by selecting <span style="font-style: italic;">“Tools -&gt; Source Code”</span>.</p>

<img src="/admin/adminContent/00.Home/img/image006.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 6</span>

<p>The administrator is more than welcome to use all the built in formatting tools presented by the editor.</p>

<h2><a id="_Toc446528722">4.3 Creating a new article</a></h2>

<p>To create a new article the <span style="font-style: italic;">“New Article”</span> button has to be pressed. On the presented article editor window, the following tasks have to be completed:</p>
<ol>
<li>Select the menu item, the article will appear under.</li>

<li>Enter or modify the order number.</li>

<li>Enter the article title. This is required! </li>

<li>If the title should not be displayed on the site, the <span style="font-style: italic;">“Title enabled?”</span> checkbox should be unchecked.</li>

<li>Enter the article subtitle. The subtitle is not required. If there is no subtitle entered, the <span style="font-style: italic;">“Subtitle enabled?”</span> checkbox should be unchecked!</li>

<li>The date of the article should be entered. If it is not required to be shown on the website, it can be disabled by unchecking the <span style="font-style: italic;">“Date enabled?”</span> checkbox.</li>

<li>The article text should be entered.</li>

<li>When all the fields have been filled and the article content is completed, by pressing the <span style="font-style: italic;">“Save”</span> button, the article will be saved.</li>
</ol>
<h2><a id="_Toc446528723">4.4 Editing an existing article</a></h2>

<p>To edit an existing article, the administrator has to find the article in the list under the <span style="font-style: italic;">“Articles”</span> menu tab, in the back-end of the site. When the article is found, the edit pictogram should be pressed, that is located in the same row as the article. At this point, the article editor window will displayed. The required information should be updated in the relevant field, and by pressing the <span style="font-style: italic;">“Save”</span> button, the article will be updated.</p>

<h2><a id="_Toc446528724">4.5 Deleting an article</a></h2>

<p>To delete an existing article, the administrator has to find the article in the list under the <span style="font-style: italic;">“Articles”</span> menu tab, in the back-end of the site. When the article is found, the delete pictogram should be pressed, that is located in the same row as the article. </p>

<p>A prompt will ask for confirmation, by requiring the user to type in the word <span style="font-style: italic;">“delete”</span>. If nothing is entered, or the word <span style="font-style: italic;">“delete”</span> is misspelled or it contains any upper case letters, the article will not be deleted. If the word <span style="font-style: italic;">“delete”</span> is entered correctly, the article will be deleted.</p>

<h2><a id="_Toc446528725">4.6 Creating a contact form</a></h2>

<p>A contact form can be placed anywhere in the site, with the creation of a special article. In the article manager, a new article has to be created, with the title <span style="font-style: italic;">“insertContactForm”</span>. The site engine will recognise this, and instead of displaying this article as an article, the contact form will be inserted in the page. </p>

<p>Any other article can be placed before and after the contact form, just in the case of the other articles.</p>

<h2><a id="_Toc446528726">4.7 Limitations</a></h2>

<p>If a new article has the same order number and same title as an old article under the same menu, to the new article title the word <span style="font-style: italic;">“_duplicate”</span> will be added. </p>

<p>Due to technical limitations, if during editing an article the same order number and title will be given to an article as an existing one, the old article will be overwritten.</p>

<br />
<h1><a id="_Toc446528727">5 Global settings</a></h1>

<p>The Global Settings page in the back-end enables the administrator to interact with the <span style="font-style: italic;">“siteSettings.json<span style="font-style: italic;">“ file which holds various settings that are used across the whole front-end and back-end of the site. After every modifications, the button <span style="font-style: italic;">“Save settings”</span> at the bottom of the page should be pressed.</p>

<h2><a id="_Toc446528728">5.1 Site name</a></h2>

<p>The <span style="font-style: italic;">“Site name”</span> filed is storing the name of the site and it influences or it is included in the following areas of the website:</p>
<ul>
<li>Front-end</li>
<ul>
<li>Title tag in the head of the site</li>

<li>The footer of the site</li>

<li>It can be used to display it in the header of the site</li>
</ul>
<li>Back-end</li>
<ul>
<li>The title tag in the head of the site</li>

<li>The footer of the admin page</li>
</ul>
<li>Miscellaneous</li>
<ul>
<li>Email header and body in the contact email</li>
</ul></ul>
<h2><a id="_Toc446528729">5.2 Site description</a></h2>

<p>The site description is used only in the head of the site as the meta description. This text would appear in the search engines as soon it is indexed by their algorithms. </p>

<p>Even though, in a similar fashion, site keywords could have been entered and included in the site source code, it would not make any difference in search engine optimisation. Google for example is no longer takes in consideration the keywords; their algorithms detect the keywords from the site content.</p>

<h2><a id="_Toc446528730">5.3 The year the site operates from</a></h2>

<p>Every website should have a footer that includes the year the company or the website operates from. If this text field is completed, the footer of the site will automatically include it in the footer of the site. </p>

<p>For example the value of this field is 2016, the site would display something like this:</p>

<p class="centerText">© 2016 - Documentation Demo</p>

<p>And the same footer next year would display:</p>

<p class="centerText">© 2016 - 2017 - Documentation Demo</p>

<h2><a id="_Toc446528731">5.4 Set the time zone of the site</a></h2>

<p>Since PHP version 5.1.0 every date-time function requires a valid time zone identifier. With this list, the administrator can select the correct time zone, the site should calculate with. </p>

<p>In QDP the date-time function is used in the footers, and the new article default date settings. </p>

<p>If the wrong time zone is used, the dates might be off by a day.</p>

<h2><a id="_Toc446528732">5.5 Template</a></h2>

<p>QDP uses a template system that can be changed from the back-end. In this dropdown each available template is listed, and the one that is currently used is selected by default.</p>

<p>A more in-depth tutorial on creating a template, will be available in the technical user manual.</p>

<h2><a id="_Toc446528733">5.6 The email address settings</a></h2>

<p>There are two email addresses stored in QDP, both are used only by the contact form:</p>
<ul>
<li>The first address, <span style="font-style: italic;">“The email address the site should write to when a contact form is sent:”</span> is the home address, where the owner of the site would like to receive the contact emails. </li>

<li>The second address, is used as the email address that will appear as the sender of these emails. This might be <span style="font-style: italic;">“norepy@example.com”</span> or an actual email address the site owner expects replies.</li>
</ul>
<h2><a id="_Toc446528734">5.7 Customise the 401, 403, 404 message</a></h2>

<p>The error message customisation feature is enabling the administrator to customise the error messages when the user reaches a non-existing link (error 404) or has no right to see the content at the address (errors 401 and 403).</p>

<p>These messages are edited by the same WYSWYG editor that is used in the article editor window, with all its functionality. These error messages can be customised with:</p>
<ul>
<li>Images, videos or any other multimedia content</li>

<li>The text can be formatted as required.</li>

<li>Custom HTML code can be used</li>
</ul>
<h2><a id="_Toc446528735">5.8 Site offline</a></h2>

<p>If for some reason, the site owner decides to hide the site content, and make it unavailable to the page visitors, the <span style="font-style: italic;">“Site offline”</span> option lets them to do that. </p>

<p>If the site is offline, the offline message is displayed instead of the actual contents of the site. This message can be formatted just as the error messages or the article contents.</p>

<br />
<h1><a id="_Toc446528736">6 Admin settings</a></h1>

<p>In the admin settings page of the back-end, the administrator is able to change some of the settings of the back-end itself. At this point, these settings include only the user management and the back-end template, but in future versions, this might be expanded.</p>

<h2><a id="_Toc446528737">6.1 User manager</a></h2>

<img src="/admin/adminContent/00.Home/img/image007.jpg">
<span style="font-size: 0.7em;font-weight:bold;"> Figure 7</span>

<p>The user management in QDP is handled by the default basic authentication on an Apache HTTP Server. A htpasswd file stores the username and the hashed password, and a htaccess file, in the protected folder keeps information about the whereabouts of the htpasswd file.</p>

<p>In the user manager window each user is displayed on a separate line in the format: <span style="font-style: italic;">“username:password”</span>.</p>

<p>The passwords should never be stored as a plain text format; it is recommended to use a hashing algorithm to hide the password.</p>

<p>This website offers to generate a secure htpasswd file content by hashing the passwords.</p>

<p><a href="http://aspirine.org/htpasswd_en.html">http://aspirine.org/htpasswd_en.html</a></p>

<p>In case the wrong password has been entered, or the file has been saved while the window was empty, please check the troubleshooting section.</p>

<h2><a id="_Toc446528738">6.2 Admin related settings</a></h2>

<p>The back-end uses the same template system as the front end. If an administrator decides to create a template for the back-end to improve the user experience he is more than welcome to do so. After the new template has been uploaded to the server, the template should appear in the dropdown.</p>

<p>A more in-depth tutorial on the admin template creation can be found in the technical user manual.</p>

<br />
<h2><a id="_Toc446528739">6.3 Additional server information</a></h2>

<p>The server info tab will display a large amount of information about the current state of PHP. This includes information about PHP compilation options and extensions, the PHP version, server information and environment (if compiled as a module), the PHP environment, OS version information, paths, master and local values of configuration options, HTTP headers, and the PHP License.</p>

<p>Because every system is setup differently, is commonly used to check configuration settings and for available predefined variables on a given system. (The PHP Group, 2016)</p>

<br />
<h1><a id="_Toc446528740">7 Other back-end features</a></h1>

<h2><a id="_Toc446528741">7.1 Documentation</a></h2>

<p>The first tab that is available in the back-end is this documentation. </p>

<h2><a id="_Toc446528742">7.2 Logout</a></h2>

<p>In the top right corner a short message is greeting the user and presents a logout button. </p>

<p>IMPORTANT!</p>

<p>Due to technical limitations the logout button will not work on every browser, or at all. During tests, it has been revealed, that this logout process will not work on Microsoft Edge browser – in this case, the browser must be closed completely! There might be other browsers that behave similarly, and not have been tested yet.</p>

<p>The safest way to log out, is to close all open browser windows and background processes or to restart the computer.</p>

<h2><a id="_Toc446528743">7.3 Preview</a></h2>

<p>At the top right corner of the site, under the Logout the <span style="font-style: italic;">“Preview site”</span> will take the user to the front-end of the site.</p>

<br />
<h1><a id="_Toc446528744">8 Troubleshooting</a></h1>

<h2><a id="_Toc446528745">8.1 Reset password</a></h2>

<p>If the administrator doesn’t have access to the site anymore due to forgetting the password, the following steps would give access to the QDP back-end:</p>

<p>Using an FTP client, the htpasswd file must be edited.</p>

<p>Because at install there are two options, on where to store the .htpasswd file, the file might be at one of these two locations:</p>
<ol>
<li>Site root/admin/sitename_pass/.htpasswd</li>

<li>One_level_up_from_public_html/sitename_pass/.htpasswd</li>
</ol>
<p>Opening the file with a text editor the password associated with the admin account can be edited. Please note, the new password should be generated on this site: <a href="http://aspirine.org/htpasswd_en.html">http://aspirine.org/htpasswd_en.html</a></p>

<h2><a id="_Toc446528746">8.2 Reset all passwords</a></h2>

<p>If all passwords need to be deleted, the same .htpasswd file must be edited as described in the reset password and a valid username and password must be saved.</p>

<h2><a id="_Toc446528747">8.3 Server errors 500</a></h2>

<p>If the back-end presents an internal server error with the code 500, it means the server cannot locate the .htpasswd file. </p>

<p>By opening the .htaccess file, it can be checked if the path to the htpasswd file is correct. The htaccess file can be found in the following locations. Both files have to have the same path.</p>
<ol>
    <li>Site_root/admin/.htaccess</li>
    <li>Site_root/admin/logout/.htaccess</li>
</ol>
<p>If the path is correct, a QDP reinstall might solve the problem. Please refer to the Reinstall section of this documentation. If a reinstall would not solve the problem, the administrator might have to contact the server administrator or contact customer support.</p>
</div>