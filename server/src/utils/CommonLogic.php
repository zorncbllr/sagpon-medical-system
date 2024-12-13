<?php

class CommonLogic
{
    static function fetchAll(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
                if (!empty(\$request->query)) {
                    \${$modelLower} = {$modelName}::find([...\$request->query]);

                    if (!\${$modelLower}) {
                        throw new PDOException(\"No related {$modelName} found.\", 404);
                    }

                    http_response_code(200);
                    return json([
                        '{$modelLower}s' => [...\${$modelLower}]
                    ]);
                }

                http_response_code(200);
                return json([
                '{$modelLower}s' => [...{$modelName}::find()]
                ]);
            
            } catch (\Throwable \$e) {

                if (\$e->getCode() === 404) {
                    http_response_code(404);      
                    return json([
                        'message' => \$e->getMessage(),
                        '{$modelLower}s' => []
                    ]);
                }

                http_response_code(500);
                return json([
                    'message' => 'Internal Server is having a hard time fulfilling request.',
                    'errors' => [
                        'server' => ['Internal Server is having a hard time fulfilling request.']
                    ]
                ]);
            }
        ");
    }

    static function fetchById(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        $id = (int) $request->param["{$modelLower}Id"];

        if ($id === 0) {
            http_response_code(400);
            return json([
                'message' => 'Invalid Id params.',
                'errors' => [
                    'id' => ['Id params must be integer type.']
                ]
            ]);
        }

        eval("
            \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

            if (!\${$modelLower}) {
                http_response_code(404);
                return json([
                    'message' => \"You're attempting to find {$modelLower} that doesn't exist.\",
                    'errors' => [
                        'id' => [\"{$modelName} with Id {$id} does not exist.\"]
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
        $modelLower = strtolower($modelName);

        $id = (int) $request->param["{$modelLower}Id"];

        if ($id === 0) {
            http_response_code(400);
            return json([
                'message' => 'Id params must be integer type.',
                'errors' => [
                    'id' => ['Invalid Id params.']
                ]
            ]);
        }

        eval("
            \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);
            \$isDeleted = {$modelLower}->delete();

            if (!\$isDeleted) {
                http_response_code(404);
                return json([
                    'message' => \"You're attempting to delete {$modelLower} that doesn't exist.\",
                    'errors' => [
                        'id' => [\"{$modelName} with Id of {$id} does not exist.\"]
                    ]
                ]);
            }

            http_response_code(200);
            return json([
                'message' => ' deleted successfully.',
                'errors' => []
             ]);
        ");
    }
}
