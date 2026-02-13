<?php
class Validator {
    private $errors = [];

    public function validate($data, $rules) {
        foreach ($rules as $field => $ruleString) {
            $value = trim($data[$field] ?? '');
            $rulesArray = explode('|', $ruleString);

            foreach ($rulesArray as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
                }
                
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = "Invalid email format.";
                }

                if (strpos($rule, 'min:') === 0) {
                    $min = explode(':', $rule)[1];
                    if (strlen($value) < $min) {
                        $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " must be at least $min characters.";
                    }
                }
                
                if ($rule === 'numeric' && !is_numeric($value)) {
                     $this->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " must be a number.";
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}
?>
