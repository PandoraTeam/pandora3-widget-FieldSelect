<?php
namespace Pandora3\Widgets\FieldSelect;

use Pandora3\Widgets\FormField\FormField;

/**
 * Class FieldSelect
 * @package Pandora3\Widgets\FieldSelect
 */
class FieldSelect extends FormField {

	/** @var array $options */
	protected $options;

	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $options
	 * @param array $context
	 */
	public function __construct(string $name, $value, array $options = [], array $context = []) {
		$this->options = $options;
		parent::__construct($name, $value, $context);
	}
	
	/**
	 * @param string $name
	 * @param mixed $value
	 * @param array $context
	 * @return static
	 */
	public static function create(string $name, $value, array $context = []) {
		return new static($name, $value, $context['options'] ?? [], $context);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getView(): string {
		return __DIR__.'/Views/Widget';
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getContext(): array {
		return array_replace( parent::getContext(), [
			'options' => $this->options
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function beforeRender(array $context): array {
		if ($context['submitOnChange'] ?? false) {
			$attribs = $context['attribs'] ?? '';
			$context['attribs'] = $attribs.' onchange="this.form.submit()"';
		}
		if ($context['disabled'] ?? false) {
			$attribs = $context['attribs'] ?? '';
			$context['attribs'] = $attribs.' disabled';
		}
		return $context;
	}
	
}