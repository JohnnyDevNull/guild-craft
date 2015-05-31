<?php
/**
 * @package Joomla.Administrator
 * @subpackage com_guildcraft
 *
 * @author Philipp John <info@jplace.de>
 * @copyright Copyright (C) 2015 Philipp John All rights reserved.
 * @link https://github.com/JohnnyDevNull/guild-craft The GitHub project page
 * @license http://www.gnu.org/licenses/gpl-3.0
 */

defined('_JEXEC') or die('RESTRICTED ACCESS');
jimport('joomla.application.component.controllerform');

/**
 * Dashboard Sub-Controller
 *
 * @since 0.0.1
 */
class GuildCraftControllerGuild extends JControllerLegacy
{
	/**
	 * @var string
	 */
	protected $default_view = 'dashboard';

	/**
	 * Triggers a getGuild Api-Request.
	 */
	public function getGuild()
	{
		$this->_performRequest('getGuild');
		parent::display();
	}

	/**
	 * Triggers a getGuildMembers Api-Request.
	 */
	public function getGuildMembers()
	{
		$this->_performRequest('getGuildMembers');
		parent::display();
	}

	/**
	 * Triggers a getDataResourceCharacterRaces Api-Request.
	 */
	public function getRaces()
	{
		$this->_performRequest('getDataResourceCharacterRaces');
		parent::display();
	}

	/**
	 * Triggers a getDataResourceCharacterClasses Api-Request.
	 */
	public function getClasses()
	{
		$this->_performRequest('getDataResourceCharacterClasses');
		parent::display();
	}

	/**
	 * Performs an Api-Request an put the result in the cache folder if theres a result.
	 *
	 * @param string $call
	 * @return null
	 * @throws Exception
	 */
	protected function _performRequest($call)
	{
		GuildCraftHelper::import('wow.authentication', 'jpWoWAuthentication');
		GuildCraftHelper::import('wow.region', 'jpWoWRegion');
		GuildCraftHelper::import('wow', 'jpWoW');

		$params = JComponentHelper::getParams('com_guildcraft');

		if(!(bool)$params->get('api_active')) {
			return;
		}

		$locale = $params->get('api_locale');
		$guildName = $params->get('guild_name');
		$guildRealm = $params->get('guild_realm');
		$region = $params->get('guild_region');

		if(empty($region) || empty($locale) || empty($guildRealm)) {
			throw new Exception('No region, locale or realm is configured');
		}

		$auth = null;

		if (
			$params->get('app_key_active')
			&& ($appKey = $params->get('app_key'))
		) {
			$auth = new jpWoWAuthentication();
			$auth->setPrivateKey($appKey);
		}

		$region = new jpWoWRegion($region, $locale);
		$wow = new jpWoW($region, $auth);

		// Disable result data decoding to allow caching the result to a json file.
		$wow->setDecodeResult(false);

		$recCount = 3;

		while($recCount) {
			$result = $wow->$call($guildName, $guildRealm);

			if(json_decode($result, true) !== null) {
				/*
				 * try it 3 times, because blizzard build the data if they
				 * haven't cached it already.
				 */
				break;
			}

			$recCount--;
			sleep(2);
		}

		GuildCraftHelper::cacheResult($result, $call);
	}

	/**
	 * Perform a complete character reset
	 */
	public function reset()
	{
		parent::display();
	}
}
