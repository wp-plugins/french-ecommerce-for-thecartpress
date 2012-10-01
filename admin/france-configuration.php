<?php
/**
 * This file is part of TheCartPress-franceSetup.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( isset( $_REQUEST['tcp-configurar-france'] ) ) :
	$settings = get_option( 'tcp_settings' ); ?>
<div id="message" class="updated">
	<?php if ( isset( $_REQUEST['tcp_formato_numerico'] ) ) : ?>
		<p>Format Numéro mis à 9.999,9</p><?php
		$settings['decimal_currency']	= 2;
		$settings['decimal_point']		= ',';
		$settings['thousands_separator']	= '.';
	endif; ?>
	<?php if ( isset( $_REQUEST['tcp_moneda'] ) ) : ?>
		<p>Monnaie mis à l'Euro (EUR)</p><?php
		$settings['currency'] = 'EUR';
	endif; ?>
	<?php if ( isset( $_REQUEST['tcp_formato_moneda'] ) ) : ?>
		<p>Format monétaire défini 999 €</p><?php
		$settings['currency_layout'] = '%2$s %1$s';
	endif; ?>
	<?php if ( isset( $_REQUEST['tcp_unidad_peso'] ) ) : ?>
		<p>Unité de poids configuré pour kg.</p><?php
		$settings['unit_weight'] = 'Kg.';
	endif; ?>
	<?php if ( isset( $_REQUEST['tcp_pais_base'] ) ) : ?>
		<p>Réglez à la base de pays France (FR).</p><?php
		$settings['country'] = 'ES';
	endif; ?>
	<?php if ( isset( $_REQUEST['tcp_pais_impuestos'] ) ) : ?>
		<p>País base para impuestos configurado a España (ES).</p><?php
		$settings['default_tax_country'] = 'ES';
	endif; ?>
</div>
<?php 
update_option( 'tcp_settings', $settings );
global $thecartpress;
if ( $thecartpress ) $thecartpress->load_settings();
endif; ?>
<div class="wrap">
	<h2>Réglages pour la France</h2>
	<ul class="subsubsub"></ul>
	<div class="clear"></div>
	<p>Cette page vous permet de configurer TheCartPress pour le marché français.</p>
	<form method="post">
	<p>Effectuer les modifications suivantes:</p>
	<ul>
		<li><label><input type="checkbox" name="tcp_formato_numerico" checked="true"/> Format numérique:: 9.999,9</label> format numérique <?php tcp_number_format_example( 9999.9, false ); ?></li>
		<li><label><input type="checkbox" name="tcp_moneda" checked="true"/> Devise: Euro. Devise courante est la suivante: <?php tcp_the_currency(); ?></li>
		<li><label><input type="checkbox" name="tcp_formato_moneda" checked="true"/> format monétaire: 999 €. Le format actuel est <?php echo tcp_format_the_price( 999 ); ?></li>
		<li><label><input type="checkbox" name="tcp_unidad_peso" checked="true"/> Unité de poids: Kg. L'unité en cours est <?php tcp_the_unit_weight(); ?></li>
		<li><label><input type="checkbox" name="tcp_pais_base" checked="true"/> Pays sur la base: FR. Le pays est actuellement <?php global $thecartpress; if ( $thecartpress ) echo $thecartpress->settings['country']; ?></li>
		<li><label><input type="checkbox" name="tcp_pais_impuestos" checked="true"/> Pays base pour les impôts: FR. Le pays est actuellement <?php echo tcp_get_default_tax_country(); ?></li>
	</ul>
	<input type="submit" value="Fixé" name="tcp-configurar-france" class="button-primary"/>
	</form>
</div>
