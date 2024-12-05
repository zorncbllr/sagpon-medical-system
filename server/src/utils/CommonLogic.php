<?php

class CommonLogic
{
    static function fetchAll(Request $request, string $modelName)
    {
        http_response_code(200);
        eval("
            return json([
                '" . strtolower($modelName) . "s' => [...{$modelName}::find()]
            ]);
        ");
    }

    static function fetchById(Request $request, string $modelName)
    {
        $id = (int) $request->param['id'];

        if ($id === 0) {
            http_response_code(400);
            return json([
                'errors' => [
                    'id' => ['Invalid query parameter Id.']
                ]
            ]);
        }

        $modelLower = strtolower($modelName);

        eval("
            \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

            if (empty(\${$modelLower})) {
                http_response_code(404);
                return json([
                    'errors' => [
                        'id' => [\"{$modelName} with Id of {$id} does not exist.\"]
                    ]
                ]);
            }

            http_response_code(200);
            return json([
                '{$modelLower}' => \${$modelLower}
            ]);
        ");
    }
}
