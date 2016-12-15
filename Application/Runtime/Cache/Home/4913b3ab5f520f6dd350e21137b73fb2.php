<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Notes</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Roboto -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700">

    <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet.min.css">
    <link rel="stylesheet" href="Application/Home/View/Public/css/ratchet-theme-ios.min.css">
    <link rel="stylesheet" href="Application/Home/View/Public/css/app.css">
    <!-- Include the compiled Ratchet JS -->
    <script src="Application/Home/View/Public/js/ratchet.min.js"></script>
  </head>
  <body>
    <header class="bar bar-nav">
      <a class="icon icon-compose pull-right" href="#composeModal"></a>
      <a href="#navPopover">
        <h1 class="title">
          <span class="icon icon-home"></span>
          Notes
          <span class="icon icon-caret"></span>
        </h1>
      </a>
    </header>

    <div class="content">

      <ul class="table-view">
  <li class="table-view-cell media">
    <a class="navigate-right">
      <span class="media-object pull-left icon icon-trash"></span>
      <div class="media-body">
        Item 1
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right">
      <span class="media-object pull-left icon icon-gear"></span>
      <div class="media-body">
        Item 2
      </div>
    </a>
  </li>
  <li class="table-view-cell media">
    <a class="navigate-right">
      <span class="media-object pull-left icon icon-pages"></span>
      <div class="media-body">
        Item 3
      </div>
    </a>
  </li>
</ul>

    </div>

  </body>
</html>