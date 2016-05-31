<?php
/**
 * @file
 * registration.features.webform.inc
 */

/**
 * Implements hook_webform_defaults().
 */
function registration_webform_defaults() {
$webforms = array();
  $webforms['event_registration'] = array(
  'title' => 'Event Registration',
  'log' => '',
  'status' => 1,
  'comment' => 0,
  'promote' => 0,
  'sticky' => 0,
  'type' => 'webform',
  'language' => 'en',
  'tnid' => 0,
  'translate' => 0,
  'title_field' => array(
    'en' => array(
      0 => array(
        'value' => 'Event Registration',
        'format' => NULL,
        'safe_value' => 'Event Registration',
      ),
    ),
  ),
  'translations' => array(
    'original' => NULL,
    'data' => array(),
  ),
  'rdf_mapping' => array(
    'rdftype' => array(
      0 => 'sioc:Item',
      1 => 'foaf:Document',
    ),
    'title' => array(
      'predicates' => array(
        0 => 'dc:title',
      ),
    ),
    'created' => array(
      'predicates' => array(
        0 => 'dc:date',
        1 => 'dc:created',
      ),
      'datatype' => 'xsd:dateTime',
      'callback' => 'date_iso8601',
    ),
    'changed' => array(
      'predicates' => array(
        0 => 'dc:modified',
      ),
      'datatype' => 'xsd:dateTime',
      'callback' => 'date_iso8601',
    ),
    'body' => array(
      'predicates' => array(
        0 => 'content:encoded',
      ),
    ),
    'uid' => array(
      'predicates' => array(
        0 => 'sioc:has_creator',
      ),
      'type' => 'rel',
    ),
    'name' => array(
      'predicates' => array(
        0 => 'foaf:name',
      ),
    ),
    'comment_count' => array(
      'predicates' => array(
        0 => 'sioc:num_replies',
      ),
      'datatype' => 'xsd:integer',
    ),
    'last_activity' => array(
      'predicates' => array(
        0 => 'sioc:last_activity_date',
      ),
      'datatype' => 'xsd:dateTime',
      'callback' => 'date_iso8601',
    ),
  ),
  'path' => array(
    'pathauto' => 1,
  ),
  'webform' => array(
    'next_serial' => 2,
    'confirmation' => '',
    'confirmation_format' => 'full_html',
    'redirect_url' => '<confirmation>',
    'status' => 1,
    'block' => 1,
    'allow_draft' => 0,
    'auto_save' => 0,
    'submit_notice' => 1,
    'confidential' => 0,
    'submit_text' => '',
    'submit_limit' => -1,
    'submit_interval' => -1,
    'total_submit_limit' => -1,
    'total_submit_interval' => -1,
    'progressbar_bar' => 1,
    'progressbar_page_number' => 0,
    'progressbar_percent' => 1,
    'progressbar_pagebreak_labels' => 1,
    'progressbar_include_confirmation' => 0,
    'progressbar_label_first' => 'Start',
    'progressbar_label_confirmation' => 'Complete',
    'preview' => 0,
    'preview_next_button_label' => '',
    'preview_prev_button_label' => '',
    'preview_title' => '',
    'preview_message' => '',
    'preview_message_format' => 'full_html',
    'preview_excluded_components' => array(),
    'machine_name' => 'event_registration',
    'record_exists' => TRUE,
    'roles' => array(
      0 => 1,
      1 => 2,
    ),
    'emails' => array(),
    'components' => array(
      'event_registration__header' => array(
        'form_key' => 'header',
        'name' => 'Header',
        'type' => 'markup',
        'value' => '<p>This registration form is only for people wanting to participate in the <strong>live gatherings</strong> happening in Switzerland. You\'ll be able to choose between Neuchâtel<i>@NIFFF</i>, Fribourg<i>@Fablab</i>, Saxon<i>@Epac</i>, Zurich<i>@MuDA</i>.</p>
<br>
<p><strong>Remember you can jam without even being in one of those places! At home, in whatever country you are, you are welcome!</strong></p>',
        'extra' => array(
          'format' => 'full_html',
          'private' => 0,
          'display_on' => 'form',
        ),
        'required' => 0,
        'weight' => 0,
        'machine_name' => 'event_registration__header',
        'page_num' => 1,
      ),
      'event_registration__name' => array(
        'form_key' => 'name',
        'name' => 'Your name',
        'type' => 'textfield',
        'value' => '[current-user:field-full-name]',
        'extra' => array(
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'width' => '',
          'maxlength' => '',
          'field_prefix' => '',
          'field_suffix' => '',
          'disabled' => 0,
          'unique' => 0,
          'description' => '',
          'placeholder' => '',
          'attributes' => array(),
          'analysis' => FALSE,
        ),
        'required' => 1,
        'weight' => 1,
        'machine_name' => 'event_registration__name',
        'page_num' => 1,
      ),
      'event_registration__email' => array(
        'form_key' => 'email',
        'name' => 'Your email',
        'type' => 'email',
        'value' => '[current-user:mail]',
        'extra' => array(
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'multiple' => 0,
          'format' => 'short',
          'width' => '',
          'unique' => 0,
          'disabled' => 0,
          'description' => '',
          'placeholder' => '',
          'attributes' => array(),
          'analysis' => FALSE,
        ),
        'required' => 1,
        'weight' => 2,
        'machine_name' => 'event_registration__email',
        'page_num' => 1,
      ),
      'event_registration__team' => array(
        'form_key' => 'team',
        'name' => 'Team name',
        'type' => 'textfield',
        'value' => '',
        'extra' => array(
          'description' => '(you absolutely don\'t need one now and can find people on site)',
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'width' => '',
          'maxlength' => '',
          'field_prefix' => '',
          'field_suffix' => '',
          'disabled' => 0,
          'unique' => 0,
          'placeholder' => '',
          'attributes' => array(),
          'analysis' => FALSE,
        ),
        'required' => 0,
        'weight' => 3,
        'machine_name' => 'event_registration__team',
        'page_num' => 1,
      ),
      'event_registration__country' => array(
        'form_key' => 'country',
        'name' => 'Country',
        'type' => 'select',
        'value' => '',
        'extra' => array(
          'items' => 'AF|Afghanistan
AX|Aland Islands
AL|Albania
DZ|Algeria
AS|American Samoa
AD|Andorra
AO|Angola
AI|Anguilla
AQ|Antarctica
AG|Antigua and Barbuda
AR|Argentina
AM|Armenia
AW|Aruba
AU|Australia
AT|Austria
AZ|Azerbaijan
BS|Bahamas
BH|Bahrain
BD|Bangladesh
BB|Barbados
BY|Belarus
BE|Belgium
BZ|Belize
BJ|Benin
BM|Bermuda
BT|Bhutan
BO|Bolivia
BA|Bosnia and Herzegovina
BW|Botswana
BV|Bouvet Island
BR|Brazil
IO|British Indian Ocean Territory
VG|British Virgin Islands
BN|Brunei
BG|Bulgaria
BF|Burkina Faso
BI|Burundi
KH|Cambodia
CM|Cameroon
CA|Canada
CV|Cape Verde
BQ|Caribbean Netherlands
KY|Cayman Islands
CF|Central African Republic
TD|Chad
CL|Chile
CN|China
CX|Christmas Island
CC|Cocos (Keeling) Islands
CO|Colombia
KM|Comoros
CG|Congo (Brazzaville)
CD|Congo (Kinshasa)
CK|Cook Islands
CR|Costa Rica
HR|Croatia
CU|Cuba
CW|Curaçao
CY|Cyprus
CZ|Czech Republic
DK|Denmark
DJ|Djibouti
DM|Dominica
DO|Dominican Republic
EC|Ecuador
EG|Egypt
SV|El Salvador
GQ|Equatorial Guinea
ER|Eritrea
EE|Estonia
ET|Ethiopia
FK|Falkland Islands
FO|Faroe Islands
FJ|Fiji
FI|Finland
FR|France
GF|French Guiana
PF|French Polynesia
TF|French Southern Territories
GA|Gabon
GM|Gambia
GE|Georgia
DE|Germany
GH|Ghana
GI|Gibraltar
GR|Greece
GL|Greenland
GD|Grenada
GP|Guadeloupe
GU|Guam
GT|Guatemala
GG|Guernsey
GN|Guinea
GW|Guinea-Bissau
GY|Guyana
HT|Haiti
HM|Heard Island and McDonald Islands
HN|Honduras
HK|Hong Kong S.A.R., China
HU|Hungary
IS|Iceland
IN|India
ID|Indonesia
IR|Iran
IQ|Iraq
IE|Ireland
IM|Isle of Man
IL|Israel
IT|Italy
CI|Ivory Coast
JM|Jamaica
JP|Japan
JE|Jersey
JO|Jordan
KZ|Kazakhstan
KE|Kenya
KI|Kiribati
KW|Kuwait
KG|Kyrgyzstan
LA|Laos
LV|Latvia
LB|Lebanon
LS|Lesotho
LR|Liberia
LY|Libya
LI|Liechtenstein
LT|Lithuania
LU|Luxembourg
MO|Macao S.A.R., China
MK|Macedonia
MG|Madagascar
MW|Malawi
MY|Malaysia
MV|Maldives
ML|Mali
MT|Malta
MH|Marshall Islands
MQ|Martinique
MR|Mauritania
MU|Mauritius
YT|Mayotte
MX|Mexico
FM|Micronesia
MD|Moldova
MC|Monaco
MN|Mongolia
ME|Montenegro
MS|Montserrat
MA|Morocco
MZ|Mozambique
MM|Myanmar
NA|Namibia
NR|Nauru
NP|Nepal
NL|Netherlands
AN|Netherlands Antilles
NC|New Caledonia
NZ|New Zealand
NI|Nicaragua
NE|Niger
NG|Nigeria
NU|Niue
NF|Norfolk Island
MP|Northern Mariana Islands
KP|North Korea
NO|Norway
OM|Oman
PK|Pakistan
PW|Palau
PS|Palestinian Territory
PA|Panama
PG|Papua New Guinea
PY|Paraguay
PE|Peru
PH|Philippines
PN|Pitcairn
PL|Poland
PT|Portugal
PR|Puerto Rico
QA|Qatar
RE|Reunion
RO|Romania
RU|Russia
RW|Rwanda
BL|Saint Barthélemy
SH|Saint Helena
KN|Saint Kitts and Nevis
LC|Saint Lucia
MF|Saint Martin (French part)
PM|Saint Pierre and Miquelon
VC|Saint Vincent and the Grenadines
WS|Samoa
SM|San Marino
ST|Sao Tome and Principe
SA|Saudi Arabia
SN|Senegal
RS|Serbia
SC|Seychelles
SL|Sierra Leone
SG|Singapore
SX|Sint Maarten
SK|Slovakia
SI|Slovenia
SB|Solomon Islands
SO|Somalia
ZA|South Africa
GS|South Georgia and the South Sandwich Islands
KR|South Korea
SS|South Sudan
ES|Spain
LK|Sri Lanka
SD|Sudan
SR|Suriname
SJ|Svalbard and Jan Mayen
SZ|Swaziland
SE|Sweden
CH|Switzerland
SY|Syria
TW|Taiwan
TJ|Tajikistan
TZ|Tanzania
TH|Thailand
TL|Timor-Leste
TG|Togo
TK|Tokelau
TO|Tonga
TT|Trinidad and Tobago
TN|Tunisia
TR|Turkey
TM|Turkmenistan
TC|Turks and Caicos Islands
TV|Tuvalu
VI|U.S. Virgin Islands
UG|Uganda
UA|Ukraine
AE|United Arab Emirates
GB|United Kingdom
US|United States
UM|United States Minor Outlying Islands
UY|Uruguay
UZ|Uzbekistan
VU|Vanuatu
VA|Vatican
VE|Venezuela
VN|Vietnam
WF|Wallis and Futuna
EH|Western Sahara
YE|Yemen
ZM|Zambia
ZW|Zimbabwe
',
          'options_source' => 'countries',
          'other_option' => 0,
          'multiple' => 0,
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'aslist' => 1,
          'empty_option' => '- Select -',
          'optrand' => 0,
          'other_text' => 'Other...',
          'description' => '',
          'custom_keys' => FALSE,
          'analysis' => TRUE,
        ),
        'required' => 1,
        'weight' => 4,
        'machine_name' => 'event_registration__country',
        'page_num' => 1,
      ),
      'event_registration__city' => array(
        'form_key' => 'city',
        'name' => 'City',
        'type' => 'textfield',
        'value' => '[current-user:field_city]',
        'extra' => array(
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'width' => '',
          'maxlength' => '',
          'field_prefix' => '',
          'field_suffix' => '',
          'disabled' => 0,
          'unique' => 0,
          'description' => '',
          'placeholder' => '',
          'attributes' => array(),
          'analysis' => FALSE,
        ),
        'required' => 1,
        'weight' => 5,
        'machine_name' => 'event_registration__city',
        'page_num' => 1,
      ),
      'event_registration__job' => array(
        'form_key' => 'job',
        'name' => 'Your job',
        'type' => 'textfield',
        'value' => '[current-user:field_job]',
        'extra' => array(
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'width' => '',
          'maxlength' => '',
          'field_prefix' => '',
          'field_suffix' => '',
          'disabled' => 0,
          'unique' => 0,
          'description' => '',
          'placeholder' => '',
          'attributes' => array(),
          'analysis' => FALSE,
        ),
        'required' => 1,
        'weight' => 6,
        'machine_name' => 'event_registration__job',
        'page_num' => 1,
      ),
      'event_registration__epic_locations' => array(
        'form_key' => 'epic_locations',
        'name' => 'Locations',
        'type' => 'optionsmarkup',
        'value' => '',
        'extra' => array(
          'items' => 'fablab_fribourg|Fablab Fribourg|<div class="well"><div class="media"><div class="media-left"><a href="http://fablab-fribourg.ch"><img class="media-object" width="150px" src="//epicgamejam.com/sites/default/files/FABLAB_LOGO_WEB_9.jpg" alt="Fablab Fribourg"></a></div><div class="media-body"><h4 class="media-heading">Fablab Fribourg</h4><p>Enjoy the amazing Fablab in Fribourg to create awesome games! Print an awesome boardgame in 3D, use a laser cutter machine to create a card game or build a crazy video game with Makey Makey!</p><p><strong>Yes, a game jam is not only for video games! It\'s a `GAME` jam!</strong></p></div></div><strong></strong></div>
epac|Epac|<div class="well"><div class="media"><div class="media-left"><a href="http://epac.ch"><img class="media-object" width="150px" src="//epicgamejam.com/sites/default/files/EpacLogo.png" alt="Epac"></a></div><div class="media-body"><h4 class="media-heading">Epac - Saxon - <a href="http://epac.ch">epac.ch</a></h4><p>If you are in Valais, you can go and meet other great and very talented jammers in Saxon, in theEpac! Great artists and setup there to come up with the perfect game!</p></div></div><strong></strong></div>
muda|MuDA|<div class="well"><div class="media"><div class="media-left"><a href="http://muda.co"><img class="media-object" width="150px" src="//epicgamejam.com/sites/default/files/muda_logo_black.png" alt="MuDA"></a></div><div class="media-body"><h4 class="media-heading">MuDA - Zurich - <a href="http://muda.co">muda.co</a></h4><p>Zurich is full of talented game creators! Join them in the shining new Museum of Digital Arts andjoin your forces to build awesome games!</p></div></div><strong></strong></div>
nifff|Neuchâtel @NIFFF|<div class="well"><div class="media"><div class="media-left"><img class="media-object" width="150px" src="//epicgamejam.com/sites/all/themes/epicgamejam/build/svg/epicgamejam_logo.svg" alt="Neuchâtel"></a></div><div class="media-body"><h4 class="media-heading">The Original™ - Neuchâtel</h4><p>The one and only. The place where it all began. The piñata of all places.</p></div></div><strong></strong></div>',
          'multiple' => 0,
          'title_display' => 'before',
          'description_above' => 0,
          'private' => 0,
          'wrapper_classes' => '',
          'css_classes' => '',
          'aslist' => NULL,
          'empty_option' => '',
          'optrand' => 0,
          'other_option' => NULL,
          'other_text' => 'Other...',
          'description' => '',
          'custom_keys' => FALSE,
          'options_source' => '',
          'analysis' => TRUE,
          'attributes' => array(),
        ),
        'required' => 1,
        'weight' => 8,
        'machine_name' => 'event_registration__epic_locations',
        'html' => TRUE,
        'page_num' => 1,
      ),
    ),
    'conditionals' => array(),
  ),
  'content_theme_content_node_edit' => 0,
  'content_theme_content_node_view' => 'epicgamejam',
  'disqus' => array(
    'status' => FALSE,
  ),
  'name' => 'admin',
  'picture' => 0,
  'data' => 'a:5:{s:16:"ckeditor_default";s:1:"t";s:20:"ckeditor_show_toggle";s:1:"t";s:14:"ckeditor_width";s:4:"100%";s:13:"ckeditor_lang";s:2:"en";s:18:"ckeditor_auto_lang";s:1:"t";}',
  'webform_features_author' => 'admin',
  'webform_features_revision_author' => '',
);
return $webforms;
}
