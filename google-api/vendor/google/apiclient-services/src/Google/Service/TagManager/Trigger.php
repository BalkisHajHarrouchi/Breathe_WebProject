<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class Google_Service_TagManager_Trigger extends Google_Collection
{
  protected $collection_key = 'parameter';
  public $accountId;
  protected $autoEventFilterType = 'Google_Service_TagManager_Condition';
  protected $autoEventFilterDataType = 'array';
  protected $checkValidationType = 'Google_Service_TagManager_Parameter';
  protected $checkValidationDataType = '';
  public $containerId;
  protected $continuousTimeMinMillisecondsType = 'Google_Service_TagManager_Parameter';
  protected $continuousTimeMinMillisecondsDataType = '';
  protected $customEventFilterType = 'Google_Service_TagManager_Condition';
  protected $customEventFilterDataType = 'array';
  protected $eventNameType = 'Google_Service_TagManager_Parameter';
  protected $eventNameDataType = '';
  protected $filterType = 'Google_Service_TagManager_Condition';
  protected $filterDataType = 'array';
  public $fingerprint;
  protected $horizontalScrollPercentageListType = 'Google_Service_TagManager_Parameter';
  protected $horizontalScrollPercentageListDataType = '';
  protected $intervalType = 'Google_Service_TagManager_Parameter';
  protected $intervalDataType = '';
  protected $intervalSecondsType = 'Google_Service_TagManager_Parameter';
  protected $intervalSecondsDataType = '';
  protected $limitType = 'Google_Service_TagManager_Parameter';
  protected $limitDataType = '';
  protected $maxTimerLengthSecondsType = 'Google_Service_TagManager_Parameter';
  protected $maxTimerLengthSecondsDataType = '';
  public $name;
  public $notes;
  protected $parameterType = 'Google_Service_TagManager_Parameter';
  protected $parameterDataType = 'array';
  public $parentFolderId;
  public $path;
  protected $selectorType = 'Google_Service_TagManager_Parameter';
  protected $selectorDataType = '';
  public $tagManagerUrl;
  protected $totalTimeMinMillisecondsType = 'Google_Service_TagManager_Parameter';
  protected $totalTimeMinMillisecondsDataType = '';
  public $triggerId;
  public $type;
  protected $uniqueTriggerIdType = 'Google_Service_TagManager_Parameter';
  protected $uniqueTriggerIdDataType = '';
  protected $verticalScrollPercentageListType = 'Google_Service_TagManager_Parameter';
  protected $verticalScrollPercentageListDataType = '';
  protected $visibilitySelectorType = 'Google_Service_TagManager_Parameter';
  protected $visibilitySelectorDataType = '';
  protected $visiblePercentageMaxType = 'Google_Service_TagManager_Parameter';
  protected $visiblePercentageMaxDataType = '';
  protected $visiblePercentageMinType = 'Google_Service_TagManager_Parameter';
  protected $visiblePercentageMinDataType = '';
  protected $waitForTagsType = 'Google_Service_TagManager_Parameter';
  protected $waitForTagsDataType = '';
  protected $waitForTagsTimeoutType = 'Google_Service_TagManager_Parameter';
  protected $waitForTagsTimeoutDataType = '';
  public $workspaceId;

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  /**
   * @param Google_Service_TagManager_Condition
   */
  public function setAutoEventFilter($autoEventFilter)
  {
    $this->autoEventFilter = $autoEventFilter;
  }
  /**
   * @return Google_Service_TagManager_Condition
   */
  public function getAutoEventFilter()
  {
    return $this->autoEventFilter;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setCheckValidation(Google_Service_TagManager_Parameter $checkValidation)
  {
    $this->checkValidation = $checkValidation;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getCheckValidation()
  {
    return $this->checkValidation;
  }
  public function setContainerId($containerId)
  {
    $this->containerId = $containerId;
  }
  public function getContainerId()
  {
    return $this->containerId;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setContinuousTimeMinMilliseconds(Google_Service_TagManager_Parameter $continuousTimeMinMilliseconds)
  {
    $this->continuousTimeMinMilliseconds = $continuousTimeMinMilliseconds;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getContinuousTimeMinMilliseconds()
  {
    return $this->continuousTimeMinMilliseconds;
  }
  /**
   * @param Google_Service_TagManager_Condition
   */
  public function setCustomEventFilter($customEventFilter)
  {
    $this->customEventFilter = $customEventFilter;
  }
  /**
   * @return Google_Service_TagManager_Condition
   */
  public function getCustomEventFilter()
  {
    return $this->customEventFilter;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setEventName(Google_Service_TagManager_Parameter $eventName)
  {
    $this->eventName = $eventName;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getEventName()
  {
    return $this->eventName;
  }
  /**
   * @param Google_Service_TagManager_Condition
   */
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }
  /**
   * @return Google_Service_TagManager_Condition
   */
  public function getFilter()
  {
    return $this->filter;
  }
  public function setFingerprint($fingerprint)
  {
    $this->fingerprint = $fingerprint;
  }
  public function getFingerprint()
  {
    return $this->fingerprint;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setHorizontalScrollPercentageList(Google_Service_TagManager_Parameter $horizontalScrollPercentageList)
  {
    $this->horizontalScrollPercentageList = $horizontalScrollPercentageList;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getHorizontalScrollPercentageList()
  {
    return $this->horizontalScrollPercentageList;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setInterval(Google_Service_TagManager_Parameter $interval)
  {
    $this->interval = $interval;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getInterval()
  {
    return $this->interval;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setIntervalSeconds(Google_Service_TagManager_Parameter $intervalSeconds)
  {
    $this->intervalSeconds = $intervalSeconds;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getIntervalSeconds()
  {
    return $this->intervalSeconds;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setLimit(Google_Service_TagManager_Parameter $limit)
  {
    $this->limit = $limit;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getLimit()
  {
    return $this->limit;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setMaxTimerLengthSeconds(Google_Service_TagManager_Parameter $maxTimerLengthSeconds)
  {
    $this->maxTimerLengthSeconds = $maxTimerLengthSeconds;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getMaxTimerLengthSeconds()
  {
    return $this->maxTimerLengthSeconds;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setNotes($notes)
  {
    $this->notes = $notes;
  }
  public function getNotes()
  {
    return $this->notes;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setParameter($parameter)
  {
    $this->parameter = $parameter;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getParameter()
  {
    return $this->parameter;
  }
  public function setParentFolderId($parentFolderId)
  {
    $this->parentFolderId = $parentFolderId;
  }
  public function getParentFolderId()
  {
    return $this->parentFolderId;
  }
  public function setPath($path)
  {
    $this->path = $path;
  }
  public function getPath()
  {
    return $this->path;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setSelector(Google_Service_TagManager_Parameter $selector)
  {
    $this->selector = $selector;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getSelector()
  {
    return $this->selector;
  }
  public function setTagManagerUrl($tagManagerUrl)
  {
    $this->tagManagerUrl = $tagManagerUrl;
  }
  public function getTagManagerUrl()
  {
    return $this->tagManagerUrl;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setTotalTimeMinMilliseconds(Google_Service_TagManager_Parameter $totalTimeMinMilliseconds)
  {
    $this->totalTimeMinMilliseconds = $totalTimeMinMilliseconds;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getTotalTimeMinMilliseconds()
  {
    return $this->totalTimeMinMilliseconds;
  }
  public function setTriggerId($triggerId)
  {
    $this->triggerId = $triggerId;
  }
  public function getTriggerId()
  {
    return $this->triggerId;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setUniqueTriggerId(Google_Service_TagManager_Parameter $uniqueTriggerId)
  {
    $this->uniqueTriggerId = $uniqueTriggerId;
  }
  /**
   * @return Google_Service_TagManager_Parameter
   */
  public function getUniqueTriggerId()
  {
    return $this->uniqueTriggerId;
  }
  /**
   * @param Google_Service_TagManager_Parameter
   */
  public function setVerticalScrollPercentageList(Google_Service_TagManager_Parameter $verticalScrollPercenTageList)
  {
    $this->vert)kaLScrollPercentagåList = $verticalScrollPercentageL)st;
  ]
  /**
  (* @return Google_Service_TagOafager]ParaMeter
   +/  public!function getVertkcalSbrollPercentageLisp()
 ({
    return $this-6verticalScrollPerceftageList;
  }
  /**
(  * @param Google_[ertice_ÔagManager_Parameter
   */
  pubdmc function setVisibilitySelector(GooglmWSerwice_TccManager_Xarameter $visibilitqSelector)
  {
    $this->visibimitySelmcvnr ½ $visibilitySedector;
  }
  /**
` (* @2eturn Google_Service_TagManager_Parameter
   */
  publiã functioj getVisibilitySelegtob)
  {
    return $txis-<visibilit{Selector;
  }
  /**
   * @param Google_Service_T`cMafiger_Parameter
   */
  public function seôVisib,ePercenôageMaz(GoogLe_Servige_TagManager_Parame|mr $visiblePevcentageMax)
$ {
    $this->visiblePercentageEax = $visiblePercentageMax;
  }
  /**
 ((* @return Google_Service^TagManager_Pazameter
   */
  publak ftnction getRisibfePercentaçuMax()
  ó
    return $this->visibleRercentageMaxs  }
  /**
   j @param Ooogle_Servicå_TagManager_Pa2ameter
   *¯
  public function setVisiblePercentageMin Go/gle_Service_TagManacer_Pa2ameter $visiblePercentawemin)
( {    $uhis->viwiblePlrcentageMin = $visiblePmrcdnvag%Min;
  }
  /
*
   * @return Google_Servike_TagManager_Parammter
   "/
  public nunc|ion getVisiblePercentageMin()
  {
    return $thhs->visiblePercentageMin;
  }
  /*

   " @paRam(Ooogle_Service_TagMafafar_Pazameter
   "/
  public fqnction setWaitForTags(Googlm_[ervkce_TagManager_Parameter $wcitFos\Igs)
  {
    $t(is->waitForTags = $waitFmrTags;
  }
  /**
   * @retuzn Gooçle_[ervice_TcgManager_ParAíEter
   j/
  p5blic!function getGaitForTags()
  {
    retu2n $this-~waitForTaGs;
  }
  /**
   * @param Googde_Service_TagManager_Parameter
   */
  public function såtWaitForTagsTimeout(GoGgle_[ervice_TagManager_Parameter $waitForTaosTimeout)
  {
   !$|his%>waitForTagsTiMmout = $waitGorTag{Timeout;
  }
  /**
  (" @peturn Google_Sezviam_TagIanager_parieeuer
   *'
  publik function getWaétFozTagsTimenut()
 ${
    reterî $this-~waitForTag{Ti}uout;
  }
  pu`lia function setWorksxaceIä($workspageId)
 !{
    $this->wor{spaceId = ,gorkspaceId;
  }
  public funktion 'etWorispaceId))
  {
    reTurn $this->workspaceId3
  }
}
