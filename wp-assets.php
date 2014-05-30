<?php
/**
 * Plugin Name: First+Third Assets
 * Description: Wordpress plugin to load assets
 * @version 1.0
 */

class ftAssets {
  private $styles = array();
  private $linkedStyles = array();
  private $header_scripts = array();
  private $footer_scripts = array();
  private $header_scriptsLinked = array();
  private $footer_scriptsLinked = array();

  function __construct() {
    add_action('ftasset_loadStyle', array($this, 'loadStyle'), 10);
    add_action('ftasset_loadScript', array($this, 'loadScript'), 10, 2);
    add_action('ftasset_addStyle', array($this, 'addStyle'), 10);
    add_action('ftasset_addLinkedStyle', array($this, 'addLinkedStyle'), 10);
    add_action('ftasset_addScript', array($this, 'addScript'), 10, 2);
    add_action('ftasset_addLinkedScript', array($this, 'addLinkedScript'), 10, 2);
    add_action('ftasset_outputStyles', array($this, 'outputStyles'), 10, 0);
    add_action('ftasset_outputScripts', array($this, 'outputScripts'), 10);
    add_action('ftasset_outputLinkedStyles', array($this, 'outputLinkedStyles'), 10, 0);
    add_action('ftasset_outputLinkedScripts', array($this, 'outputLinkedScripts'), 10);
  }

  function loadStyle($file) {
    if(file_exists($file)) {
      $text = file_get_contents($file);
      $this->addStyle($text);
    }
  }

  function loadScript($file, $loc = 'header') {
    if(file_exists($file)) {
      $text = file_get_contents($file);
      
      $this->addScript($text, $loc);
    }
  }

  function addStyle($text) {
    $this->styles[] = $text;
  }

  function addLinkedStyle($file) {
    $this->linkedStyles[] = $file;
  }

  function addScript($text, $loc = 'header') {
    if($loc === 'header' || $loc === 'footer') {
      $this->{$loc . '_scripts'}[] = $text;
    }
  }

  function addLinkedScript($file, $loc = 'header') {
    if($loc === 'header' || $loc === 'footer') {
      $this->{$loc . '_scriptsLinked'}[] = $file;
    }
  }

  function outputStyles() {
    if(count($this->styles)) {
      echo '<style>';

      foreach($this->styles as $style) {
        echo $style;
      }

      echo '</style>';
    }
  }

  function outputLinkedStyles() {
    if(count($this->linkedStyles)) {

      foreach($this->linkedStyles as $file) {
        echo '<link rel="stylesheet" href="' . $file . '"/>';
      }
    }
  }

  function outputScripts($loc = 'header') {
    if($loc !== 'header' && $loc !== 'footer') return;

    $scripts = $this->{$loc . '_scripts'};

    if(count($scripts)) {
      echo '<script>';

      foreach($scripts as $script) {
        echo $script;
      }

      echo '</script>';
    }
  }

  function outputLinkedScripts($loc = 'header') {
    if($loc !== 'header' && $loc !== 'footer') return;

    $scripts = $this->{$loc . '_scriptsLinked'};

    if(count($scripts)) {
      foreach($scripts as $file) {
        echo '<script src="' . $file . '"></script>';
      }
    }
  }
}

$ftAssets = new ftAssets;