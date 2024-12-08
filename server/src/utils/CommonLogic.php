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
                'msg' => 'Id params must be integer type.',
                'errors' => [
                    'id' => ['Invalid Id params.']
                ]
            ]);
        }

        $modelLower = strtolower($modelName);

        eval("
            \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

            if (empty(\${$modelLower})) {
                http_response_code(404);
                return json([
                    'msg' => \"You're attempting to find {$modelLower} that doesn't exist.\",
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

    static function deleteHandler(Request $request, string $modelName)
    {
        $id = (int) $request->param['id'];

        if ($id === 0) {
            http_response_code(400);
            return json([
                'msg' => 'Id params must be integer type.',
                'errors' => [
                    'id' => ['Invalid Id params.']
                ]
            ]);
        }

        $modelLower = strtolower($modelName);

        eval("
            \$isDeleted = {$modelName}::delete(\$id);

            if (!\$isDeleted) {
                http_response_code(404);
                return json([
                    'msg' => \"You're attempting to delete {$modelLower} that doesn't exist.\",
                    'errors' => [
                        'id' => [\"{$modelName} with Id of {$id} does not exist.\"]
                    ]
                ]);
            }

            http_response_code(200);
            return json([
                'msg' => ' deleted successfully.',
                'errors' => []
             ]);
        ");
    }
}
