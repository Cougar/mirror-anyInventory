<?php

// German language file
define('LANGUAGE','Sprache');
define('SWITCH_TO_LIST','&Auml;ndern Sie zur Liste');
define('SWITCH_TO_TABLE','&Auml;ndern Sie zum Rasterfield');
define('ID_MATCH','&auml;hnliche '.AUTO_INC_FIELD_NAME);
define('NAME_MATCH','&auml;hnliche '.NAME_FIELD_NAME);

// Dates
define('MONTH_1','Januar');
define('MONTH_2','Februar');
define('MONTH_3','M�rz');
define('MONTH_4','April');
define('MONTH_5','Mai');
define('MONTH_6','Juni');
define('MONTH_7','Juli');
define('MONTH_8','August');
define('MONTH_9','September');
define('MONTH_10','Oktober');
define('MONTH_11','November');
define('MONTH_12','Dezember');

// XML
define('DOWNLOAD_LINK','download');
define('DOWNLOAD_AS_XML','Download der Inventar-Eintr�ge als XML file');

// General
define('APP_TITLE','anyInventory');
define('HOME','Home');
define('ADMINISTRATION','Administration');
define('APPLIES_TO','Anwenden auf');
define('ACTIVE_WHEN','Aktiv wenn');
define('FOOTER_TEXT_PRE','Sie haben inventarisiert');
define('ANYINVENTORY_LINK','<a href="http://anyinventory.sourceforge.net/">anyInventory, dass flexible und m�chtigste web-basierte Inventar-System</a>');
define('FOOTER_TEXT_POST','Eintr�ge mit '.ANYINVENTORY_LINK);
define('HELP','Hilfe');
define('EDIT','Editieren');
define('_DELETE','L�schen');
define('CANCEL','Cancel');
define('SUBMIT','Absenden');
define('VALUE','Wert');
define('NAME','Name');
define('EDIT_LINK','editieren');
define('DELETE_LINK','l�schen');
define('TYPE','Typ');
define('SELECT_NONE','Keine Auswahl');
define('SUBMIT_REPORT','Sie k�nnen bei der Entwicklung von anyInventory mitwirken, indem Sie diesen Fehlerreport an <a href="https://sourceforge.net/tracker/?func�d&amp;group_id.0239&amp;atide5777">senden</a>.');

// Search
define('SEARCH','Suchen');
define('SEARCH_RESULTS','Such-Ergebnisse');
define('IN','In');
define('NO_RESULTS','Keine Treffer');
define('NO_MATCHING_ITEMS','Es wurden keine Treffer zu Ihren Such-Kriterien gefunden.');

// Error messages
define('ERROR','Fehler');
define('ACCESS_DENIED','Zugriff verweigert');
define('ERROR_DUPLICATE_FIELD',"Es gibt bereits ein Feld mit diesem Namen. Wenn Sie ein Feld zu mehreren Kategorien erg�nzen m�chten k�nnen Sie dies tun, indem sie das Feld editieren und mehrere Kategorien w�hlen indem Sie die Strg-Taste festhalten.");
define('ERROR_BAD_DEFAULT_VALUE',"Der Standard-Wert f�r eine Auswahl oder ein Radio-Feld muss in die Werteliste eingeschlossen werden.");
define('ERROR_EMPTY_CATEGORY',"Es sind keine Eintr�ge in den ausgew�hlten Kategorien; dies ist notwendig um Warnungen darin anzulegen.");
define('ERROR_NO_COMMON_FIELDS',"Es sind keine gemeinsamen Felder in den ausgew�hlten Kategorien.");
define('ERROR_ALERT_NO_CATEGORIES','Eine Warnung muss mindestens einer Kategorie zugeordnet sein.');
define('ERROR_ALERT_NO_ITEMS','Eine Warnung muss zu mindestens einem Inventar-Eintrag zugeordnet werden.');
define('ERROR_NO_TOP_LEVEL_EDIT','Die '.TOP_LEVEL_CATEGORY.' Kategorie kann nicht editiert oder gel�scht werden.');
define('ERROR_NO_VALUES','Sie m�ssen dem Feld eine Liste von Werten zuordnen.');
define('ERROR_PRIVELEGES','Sie haben nicht die n�tige Rechte.');
define('ERROR_DELETE_OWN_ACCOUNT','Sie k�nnen nicht Ihren eigenen Benutzer-Account l�schen.');
define('ERROR_DUPLICATE_USER','Ein Benutzer mit diesem Namen existiert bereits.');

// Labels
define('LABEL','Label');
define('LABELS','Labels');
define('LABEL_ERROR','Sie haben nicht alle notwendigen PHP-Funktionen installiert um Label zu entwerfen. Diese Funktionen sind: <a href="http://us3.php.net/manual/en/function.imagecreate.php">imagecreate</a>, <a href="http://us3.php.net/manual/en/function.imagecolorallocate.php">imagecolorallocate</a>, <a href="http://us3.php.net/manual/en/function.imagettftext.php">imagettftext</a>, <a href="http://us3.php.net/manual/en/function.imagestring.php">imagestring</a>, <a href="http://us3.php.net/manual/en/function.imagecopyresized.php">imagecopyresized</a>, <a href="http://us3.php.net/manual/en/function.imagedestroy.php">imagedestroy</a>, und <a href="http://us3.php.net/manual/en/function.imagepng.php">imagepng</a>. Eine oder mehrere dieser Funktionen sind nicht installiert.');
define('LABEL_CAT_INSTRUCTIONS','W�hlen Sie die Kategorien aus, zu denen die Eintr�ge geh�ren, zu denen dann Labels produziert werden sollen. Alle ausgew�hlten Kategorien m�ssen mindestens ein gemeinsames Feld besitzen.');
define('LABEL_ITEM_INSTRUCTIONS','W�hlen Sie das Feld aus, von dem der Bar-Code produziert werden soll und die Eintr�ge, zu denen die Labels produziert werden sollen.');
define('GENERATE_LABELS','Label erzeugen');
define('GENERATE_FROM','Erzeugen von');
define('GENERATE_FOR','Erzeugen f�r');

// Fields
define('FIELD','Feld');
define('FIELDS','Felder');
define('ADD_FIELD','Feld erg�nzen');
define('DATA_TYPE','Data Typ');
define('TEXT','Text');
define('RADIO','Radio Buttons');
define('CHECKBOX','Checkboxes');
define('SELECT_BOX','Box ausw�hlen');
define('MULTIPLE','Mehrfach ('.TEXT.'   '.SELECT_BOX.')');
define('FILE','File');
define('VALUES','Wert');
define('DEFAULT_VALUE','Standard Wert');
define('VALUES_INFO',"Nur f�r Daten vom Typ 'Multiple', 'Select Box', 'Checkbox', und 'Radio Buttons.'  Unterteilen mit Komma.");
define('DEFAULT_VALUE_INFO',"Nur f�r Daten vom Typ 'Multiple', 'Select Box', 'Text', und 'Radio Buttons.'");
define('SIZE','Gr��e, in Zeichen');
define('_SIZE','Gr��e');
define('SIZE_INFO',"Nur f�r 'text' Daten Typ.");
define('HIGHLIGHT','Markiert');
define('HIGHLIGHT_FIELD','Markiere dieses Feld');
define('DELETE_FIELD','Feld l�schen');
define('DELETE_FIELD_CONFIRM','Sind Sie sicher, das Feld zu l�schen?');
define('NONE','Kein');
define('FIELD_CATS_PRE','Dieses Feld wird benutzt in');
define('AUTO_INCREMENT','automatischer Z�hler');
define('SHOW_AUTOINC_FIELD','Zeige Feld mit automatischem Z�hler');
define('DIVIDER','Trenner');
define('ADD_DIVIDER','Erg�nze Trenner');
define('_FRONT_PAGE_TEXT','Text des Deckblatts');
define('_NAME_FIELD_NAME','"Name" Feld-Name');
define('DOWN_LINK','nach Unten');
define('UP_LINK','nach Oben');
define('EDIT_AUTOINC_FIELD','Editiere Feld mit automatischem Z�hler');
define('EDIT_FRONT_PAGE_TEXT','Editiere Text des Deckblatts');
define('EDIT_NAME_FIELD','Editiere Namens-Feld');
define('APPLY_FIELDS',"Dieses Feld allen Untekategorien zuordnen.");
define('ED','Feld editieren');

// Categories
define('CATEGORIES','Kategorien');
define('ADD_CATEGORY','Kategorie erg�nzen');
define('TOP_LEVEL_CATEGORY','Top');
define('INHERIT_FIELDS','Inh�rentes Feld zur Oberkategorie (erg�nzend zu den unten stehenden Feldern)');
define('ADD_CAT_HERE','Kategorie hier erg�nzen');
define('NO_SUBCATS','Es sind keine Unter-Kategorien in dieser Kategorie.');
define('SUBCATS_IN','Sub-categories in');
define('PARENT_CATEGORY','�bergeordnete Kategorie');
define('DELETE_CATEGORY','Kategorie l�schie');
define('DELETE_CATEGORY_CONFIRM','Sind Sie sicher, dass Sie die Kategorie l�schen wollen?');
define('NUM_ITEMS','Anzahl der Eintr�ge');
define('NUM_ITEMS_R','Anzahl der Eintr�ge in dieser und allen Unterkategorien');
define('DELETE_ALL_ITEMS','Alle Eintr�ge in dieser Kategorie l�schen.');
define('MOVE_ITEMS_TO','Alle Eintr�ge dieser Kategorie verschieben nach ');
define('NUM_SUBCATS','Anzahl der Unterkategorien');
define('DELETE_ALL_SUBCATS','Alle Unterkategorien l�schen');
define('MOVE_SUBCATS_TO','Alle Unterkategorien verschieben nach');
define('NUM_ITEMS_TO','Anzahl der Eintr�ge in dieser <br /> Kategorie und deren Unterkategorien');
define('UPDATE_CATEGORIES','Kategorien updaten ');
define('EDIT_CATEGORY','Kategorie editieren');

// Items
define('ITEMS','Eintrag');
define('ADD_ITEM','Eintrag hinzuf�gen');
define('ADD_ITEM_HERE','Eintrag hier hinzuf�gen');
define('ADD_ITEM_TO','Eintrag hinzuf�gen zu');
define('ITEMS_IN_CAT','Eintr�ge in dieser Kategorie');
define('NO_ITEMS_HERE','Es sind keine Eintr�ge in dieser Kategorie.');
define('MOVE','verschieben');
define('MOVE_LINK','verschieben');
define('RELATED_ITEMS','Eintr�ge mit Bezug');
define('MORE_ITEMS',' et. al.');
define('DELETE_ITEM','Eintrag l�schen');
define('DELETE_ITEM_CONFIRM','Sind Sie sicher, den Eintrag zu l�schen?');
define('MOVE_ITEM','Eintrag verschieben');
define('MOVE_TO','Verschieben nach');
define('EDIT_ITEM','Eintrag editieren');

// Alerts
define('ALERT','Warnung');
define('ALERTS','Warnungen');
define('EFFECTIVE_DATE','G�ltig ab');
define('CONDITION','Bedingung');
define('ADD_ALERT','Warnung hinzuf�gen');
define('ADD_ALERT_IN','Warnung hinzuf�gen zu');
define('ALERT_TITLE','Titel der Warnung');
define('TIMED_ONLY_LABEL','Diese Warnung nur  <a href="../docs/de/alerts.php#time_based">zeitbasiert einstellen.</a>.');
define('TIMED_ONLY_EXPLANATION','F�r zeitbasierte Warnungen brauchen Sie nicht das Feld, Bedingung oder Wert eingeben.');
define('DELETE_ALERT','Warnung l�schen');
define('DELETE_ALERT_CONFIRM','Sind Sie sicher, die Warnung zu l�schen?');
define('EDIT_ALERT','Warnung editieren');
define('EXPIRATION_DATE','Verfall-Datum');
define('ALLOW_EXPIRATION','Dieser Warnung erlauben, ung�ltig zu werden');
define('EMAIL_ALERT_TO','E-mail-Warnung schicken an');
define('EMAIL_ALERT_INFO','Wenn Sie nicht per e-mail benachrichtigt werden m�chten lassen Sie das Feld leer.');
define('ALERT_ACTIVATED_BY','Diese Warnung wurde urspr�nglich durch diesen Eintrag aktiviert.');

// Users
define('USERS','Benutzer');
define('ADD_USER','Benutzer erg�nzen');
define('LOGIN','Login');
define('LOG_OUT','Log Out');
define('USERNAME','Benutzername');
define('PASSWORD','Passwort');
define('GIVE_VIEW_TO','Anzeige-Privilegien geben an');
define('GIVE_ADMIN_TO','Admin-Privilegien geben an');
define('CAN_VIEW','Kann sehen');
define('CAN_ADMIN','Kann verwalten');
define('ALL','Alle');
define('USER_TYPE','Benutzer-typ');
define('DELETE_USER','Benutzer l�schen');
define('DELETE_USER_CONFIRM','Sind Sie sicher, den Benutzer zu l�schen?');
define('EDIT_PASSWORD_INFO','Wenn Sie kein neues Passwort eingeben bleibt das alte unver�ndert bestehen.');
define('USER','Benutzer');
define('ADMINISTRATOR','Administrator');
define('EDIT_USER','Benutzer editieren');

?>