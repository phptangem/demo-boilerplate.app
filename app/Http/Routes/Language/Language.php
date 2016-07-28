<?php
/**
 * Sets the specified locale to session
 */
Route::get('lang/{lang}', 'LanguageController@swap');