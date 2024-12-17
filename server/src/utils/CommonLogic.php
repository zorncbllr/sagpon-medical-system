<?php

class CommonLogic
{
    static function fetchAll(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
                \${$modelLower} = {$modelName}::query(\"SELECT * FROM users INNER JOIN patients ON users.userId = patients.userId;\");

                http_response_code(200);
                return json([
                '{$modelLower}s' => [...\${$modelLower}]
                ]);
            
            } catch (PDOException \$e) {

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

        eval("
            try {
                \$id = (int) \$request->param[\"{$modelLower}Id\"];

                if (\$id === 0) {
                    throw new PDOException('Invalid {$modelLower}Id parameter.', 400);
                }

                \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

                if (!\${$modelLower}) {
                    throw new PDOException(\"{$modelName} with Id {\$id} does not exist.\", 404);
                }

                http_response_code(200);
                return json([
                    '{$modelLower}' => \${$modelLower}
                ]);s

            } catch (PDOException \$e) {
                
                if (\$e->getCode() === 404 || \$e->getCode() === 400) {
                    http_response_code(\$e->getCode());
                    return json([
                        'message' => \$e->getMessage(),
                        'errors' => [
                            '{$modelLower}Id' => [\$e->getMessage()]
                        ]
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

    static function deleteHandler(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
                \$id = \$request->param[\"{$modelLower}Id\"];

                \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);
                
                if (!\${$modelLower}) {
                    throw new PDOException(\"{$modelName} with Id of {\$id} does not exist.\", 404);
                }

                \${$modelLower}->delete();

                http_response_code(205);
                return json([
                    'message' => ' deleted successfully.',
                    'errors' => []
                ]);
            } catch (PDOException \$e) {
                
                if (\$e->getCode() === 400 || \$e->getCode() === 404) {
                    http_response_code(\$e->getCode());
                    return json([
                        'message' => \$e->getMessage(),
                        'errors' => [
                            '{$modelLower}Id' => [\$e->getMessage()]
                        ]
                    ]);
                }

                http_response_code(500);
                return json([
                    'message' => 'Internal Server is having a hard time fulfilling delete request.',
                    'errors' => [
                        'server' => ['Internal Server is having a hard time fulfilling delete request.']
                    ]
                ]);
            }
        ");
    }


    static function updateHandler(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
			\$id = htmlspecialchars(\$request->param['{$modelLower}Id']);

			\${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

			if (!\${$modelLower}) {
				throw new PDOException(\"{$modelName} with Id {\$id} does not exist.\", 404);
			}

			foreach (\$request->body as \$field => \$value) {
				\$request->body[\$field] = htmlspecialchars(\$value);
				if (\$field == 'password') {
					\$request->body['password'] = password_hash(
						\$request->body['password'],
						PASSWORD_DEFAULT
					);
				}
			}

			\${$modelLower}->update(...\$request->body);

			http_response_code(201);
			return json([
				'message' => 'User updated successfully.',
				'errors' => []
			]);
		} catch (PDOException \$e) {

			if (\$e->getCode() === 404) {
				http_response_code(404);
				return json([
					'message' => \$e->getMessage(),
					'errors' => [
						'userId' => [\$e->getMessage()]
					]
				]);
			}

			if (\$e->getCode() === 23000) {
				http_response_code(409);
				return json([
					'message' => \"User with email {\$request->body['email']} already exists.\",
					'errors' => [
						'email' => [\"User with email {\$request->body['email']} already exists.\"]
					]
				]);
			}

			http_response_code(500);
			return json([
				'message' => 'Internal Server is having a hard time fulfilling update request.',
				'errors' => [
					'server' => ['Internal Server is having a hard time fulfilling update request.']
				]
			]);
		}
        ");
    }

    static function registerHandler(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
                \${$modelLower} = new {$modelName}(...\$request->body);

                \${$modelLower}->save();

                http_response_code(201);
                return json([
                    'message' => '{$modelName} successfully registered.',
                    '{$modelLower}' => \${$modelLower},
                ]);
            } catch (PDOException \$e) {

                if (\$e->getCode() === '23000') {
                    http_response_code(409);
                    return json([
                        'message' => \"User with email {\$request->body['email']} already exists.\",
                        'errors' => [
                            'email' => [\"User with email {\$request->body['email']} already exists.\"]
                        ]
                    ]);
                }

                http_response_code(500);
                return json([
                    'message' => 'Internal Server is having a hard time fulfilling register request.',
                    'errors' => [
                        'server' => ['Internal Server is having a hard time fulfilling register request.']
                    ]
                ]);
            }
        ");
    }
}
