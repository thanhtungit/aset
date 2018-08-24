<?php
/**
 * @package        solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license        GNU GPL version 3 or later
 */

use Awf\Text\Text;

/** @var \Solo\View\Profiles\Html $this */
$router = $this->container->router;
$token = $this->container->session->getCsrfToken()->getValue();

if (!$this->getModel()->getId())
{
	$id = 0;
	$description = '';
}
else
{
	$id = $this->getModel()->getId();
	$description = $this->getModel()->description;
}
?>
<form action="<?php echo $router->route('index.php?view=profiles')?>" method="POST" name="adminForm" id="adminForm"
      class="akeeba-form--horizontal--with-hidden" role="form">
	<div class="akeeba-form-group">
		<label class="hasTooltip" for="description" title="<?php echo Text::_('COM_AKEEBA_PROFILES_LABEL_DESCRIPTION_TOOLTIP') ?>">
			<?php echo Text::_('COM_AKEEBA_PROFILES_LABEL_DESCRIPTION')?>
		</label>
        <input type="text" name="description" class="form-control" id="description" value="<?php echo $description; ?>" required>
	</div>

    <div class="akeeba-hidden-fields-container">
        <input type="hidden" name="boxchecked" id="boxchecked" value="0"/>
        <input type="hidden" name="task" id="task" value=""/>
        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="token" value="<?php echo $token ?>">
    </div>
</form>
