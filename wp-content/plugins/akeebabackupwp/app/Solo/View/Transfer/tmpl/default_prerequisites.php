<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

// Protect from unauthorized access
use Awf\Text\Text;

/** @var  $this  Solo\View\Transfer\Html */

$classModifier = empty($this->latestBackup) ? 'red' : 'information';
?>

<div class="akeeba-panel--<?php echo $classModifier ?>">
    <header class="akeeba-block-header">
        <h3>
            <?php echo Text::_('COM_AKEEBA_TRANSFER_HEAD_PREREQUISITES'); ?>
        </h3>
	</header>

	<table class="akeeba-table--striped" width="100%">
        <tbody>
        <tr>
            <td>
                <strong>
			        <?php echo Text::_('COM_AKEEBA_TRANSFER_LBL_COMPLETEBACKUP') ?>
                </strong>

                <br/>
                <small>
			        <?php if (empty($this->latestBackup)): ?>
				        <?php echo Text::_('COM_AKEEBA_TRANSFER_ERR_COMPLETEBACKUP'); ?>
			        <?php else: ?>
				        <?php echo Text::sprintf('COM_AKEEBA_TRANSFER_LBL_COMPLETEBACKUP_INFO', $this->lastBackupDate); ?>
			        <?php endif; ?>
                </small>
            </td>
            <td width="20%">
		        <?php if (empty($this->latestBackup)): ?>
                    <a href="<?php echo $this->getContainer()->router->route('index.php?view=backup'); ?>" class="btn akeeba-btn--green"
                       id="akeeba-transfer-btn-backup">
				        <?php echo Text::_('COM_AKEEBA_BACKUP_LABEL_START'); ?>
                    </a>
		        <?php endif; ?>
            </td>
        </tr>
        <?php if (!empty($this->latestBackup)): ?>
        <tr>
            <td>
                <strong>
                    <?php echo Text::sprintf('COM_AKEEBA_TRANSFER_LBL_SPACE', $this->spaceRequired['string']); ?>
                </strong>
                <br/>
                <small id="akeeba-transfer-err-space" style="display: none">
                    <?php echo Text::_('COM_AKEEBA_TRANSFER_ERR_SPACE'); ?>
                </small>
            </td>
            <td>
            </td>
        </tr>
        <?php endif; ?>
        </tbody>
	</table>
</div>

