First+Third Assets
=========

Wordpress plugin to load assets

## Installation

Install to plugin directory.

## Usage

```php
do_action($action, $param...);
```

| Action                      | Params                         |                                |
| :-------------------------- | :----------------------------- | :----------------------------- |
| ftasset_loadStyle           | Path to file                   |                                |
| ftasset_loadScript          | Path to file                   | Location: `header` or `footer` |
| ftasset_addStyle            | String of text                 |                                |
| ftasset_addLinkedStyle      | Url to stylesheet              |                                |
| ftasset_addScript           | String of text                 | Location: `header` or `footer` |
| ftasset_addLinkedScript     | Url to script                  | Location: `header` or `footer` |
| ftasset_outputStyles        |                                |                                |
| ftasset_outputLinkedStyles  |                                |                                |
| ftasset_outputScripts       | Location: `header` or `footer` |                                |
| ftasset_outputLinkedScripts | Location: `header` or `footer` |                                |

### Add vs. Load vs. Linked

Add and Load are essentially the same thing. Load will grab the contents of the file and renders it inline on the page, the same as Add.

Linked will create an external reference to a file. Contents of these files are not parsed or their existence validated.

## Example

page.php
```php
<html>
<head>
  <title>Test template</title>
  <?php 
    do_action('ftasset_outputLinkedStyles');
    do_action('ftasset_outputStyles');

    do_action('ftasset_outputLinkedScripts', 'header');
    do_action('ftasset_outputScripts', 'header');
  ?>
</head>
<body>

<?php
  do_action('ftasset_outputLinkedScripts', 'footer');
  do_action('ftasset_outputScripts', 'footer');
?>
</body>
</html>
```

functions.php
```php
<?php
  do_action('ftasset_addStyle', 'body { background: superVeryBrightHotPink; }');
  do_action('ftasset_outputLinkedStyles', '/css/common.css');
  do_action('ftasset_addScript', 'alert(1);', 'footer');
  do_action('ftasset_addLinkedScript', 'http://code.jquery.com/jquery-1.11.0.min.js', 'header');
  do_action('ftasset_addLinkedScript', 'http://code.jquery.com/jquery-migrate-1.2.1.min.js', 'header');
?>
```