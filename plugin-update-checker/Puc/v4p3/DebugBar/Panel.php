<?php

if ( !class_exists('Puc_v4p3_DebugBar_Panel', false) && class_exists('Debug_Bar_Panel', false) ):

	class Puc_v4p3_DebugBar_Panel extends Debug_Bar_Panel {
		/** @var Puc_v4p3_UpdateChecker */
		protected $updateChecker;

		private $responseBox = '<div class="puc-ajax-response" style="display: none;"></div>';

		public function __construct($updateChecker) {
			$this->updateChecker = $updateChecker;
			$title = sprintf(
				'<span class="puc-debug-menu-link-%s">PUC (%s)</span>',
				esc_attr($this->updateChecker->getUniqueName('uid')),
				$this->updateChecker->slug
			);
			parent::__construct($title);
		}

		public function render() {
			printf(
				'<div class="puc-debug-bar-panel-v4" id="%1$s" data-slug="%2$s" data-uid="%3$s" data-nonce="%4$s">',
				esc_attr($this->updateChecker->getUniqueName('debug-bar-panel')),
				esc_attr($this->updateChecker->slug),
				esc_attr($this->updateChecker->getUniqueName('uid')),
				esc_attr(wp_create_nonce('puc-ajax'))
			);

			$this->displayConfiguration();
			$this->displayStatus();
			$this->displayCurrentUpdate();

			echo '</div>';
		}

		private function displayConfiguration() {
			echo '<h3>構成</h3>';
			echo '<table class="puc-debug-data">';
			$this->displayConfigHeader();
			$this->row('スラグ', htmlentities($this->updateChecker->slug));
			$this->row('DBオプション', htmlentities($this->updateChecker->optionName));

			$requestInfoButton = $this->getMetadataButton();
			$this->row('メタデータURL', htmlentities($this->updateChecker->metadataUrl) . ' ' . $requestInfoButton . $this->responseBox);

			$scheduler = $this->updateChecker->scheduler;
			if ( $scheduler->checkPeriod > 0 ) {
				$this->row('自動チェック', '毎 ' . $scheduler->checkPeriod . ' 時間');
			} else {
				$this->row('自動チェック', '無効');
			}

			if ( isset($scheduler->throttleRedundantChecks) ) {
				if ( $scheduler->throttleRedundantChecks && ($scheduler->checkPeriod > 0) ) {
					$this->row(
						'Throttling',
						sprintf(
							'有効になります。更新プログラムが既に利用可能な場合は、%2$d時間ごとではなく、%1$d時間ごとに更新を確認しください。', 
							$scheduler->throttledCheckPeriod,
							$scheduler->checkPeriod
						)
					);
				} else {
					$this->row('スロットリング', '無効');
				}
			}

			$this->updateChecker->onDisplayConfiguration($this);

			echo '</table>';
		}

		protected function displayConfigHeader() {
			//Do nothing. This should be implemented in subclasses.
		}

		protected function getMetadataButton() {
			return '';
		}

		private function displayStatus() {
			echo '<h3>状態</h3>';
			echo '<table class="puc-debug-data">';
			$state = $this->updateChecker->getUpdateState();
			$checkNowButton = '';
			if ( function_exists('get_submit_button')  ) {
				$checkNowButton = get_submit_button(
					'今すぐチェック',
					'secondary',
					'puc-check-now-button',
					false,
					array('id' => $this->updateChecker->getUniqueName('check-now-button'))
				);
			}

			if ( $state->getLastCheck() > 0 ) {
				$this->row('最後のチェック', $this->formatTimeWithDelta($state->getLastCheck()) . ' ' . $checkNowButton . $this->responseBox);
			} else {
				$this->row('最後のチェック', 'Never');
			}

			$nextCheck = wp_next_scheduled($this->updateChecker->scheduler->getCronHookName());
			$this->row('次の自動チェック', $this->formatTimeWithDelta($nextCheck));

			if ( $state->getCheckedVersion() !== '' ) {
				$this->row('バージョンを確認する', htmlentities($state->getCheckedVersion()));
				$this->row('キャッシュされた更新', $state->getUpdate());
			}
			$this->row('チェッカークラスを更新する', htmlentities(get_class($this->updateChecker)));
			echo '</table>';
		}

		private function displayCurrentUpdate() {
			$update = $this->updateChecker->getUpdate();
			if ( $update !== null ) {
				echo '<h3>アップデートが利用可能です</h3>';
				echo '<table class="puc-debug-data">';
				$fields = $this->getUpdateFields();
				foreach($fields as $field) {
					if ( property_exists($update, $field) ) {
						$this->row(ucwords(str_replace('_', ' ', $field)), htmlentities($update->$field));
					}
				}
				echo '</table>';
			} else {
				echo '<h3>現在利用可能なアップデートはありません</h3>';
			}
		}

		protected function getUpdateFields() {
			return array('version', 'download_url', 'slug',);
		}

		private function formatTimeWithDelta($unixTime) {
			if ( empty($unixTime) ) {
				return 'Never';
			}

			$delta = time() - $unixTime;
			$result = human_time_diff(time(), $unixTime);
			if ( $delta < 0 ) {
				$result = 'after ' . $result;
			} else {
				$result = $result . ' ago';
			}
			$result .= ' (' . $this->formatTimestamp($unixTime) . ')';
			return $result;
		}

		private function formatTimestamp($unixTime) {
			return gmdate('Y-m-d H:i:s', $unixTime + (get_option('gmt_offset') * 3600));
		}

		public function row($name, $value) {
			if ( is_object($value) || is_array($value) ) {
				$value = '<pre>' . htmlentities(print_r($value, true)) . '</pre>';
			} else if ($value === null) {
				$value = '<code>null</code>';
			}
			printf('<tr><th scope="row">%1$s</th> <td>%2$s</td></tr>', $name, $value);
		}
	}

endif;
