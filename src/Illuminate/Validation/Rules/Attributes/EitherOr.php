<?php

namespace Illuminate\Validation\Rules\Attributes;

#[Attribute(Attribute::TARGET_METHOD)]
class EitherOr implements RuleAttribute
{
    public function __construct(
        public string $either,
        public string $or,
    ) {}

    public function rules(): array
    {
        return [
            $this->either => ['required_without:'.$this->or, 'prohibits:'.$this->or],
            $this->or => ['required_without:'.$this->either, 'prohibits:'.$this->either],
        ];
    }
}
