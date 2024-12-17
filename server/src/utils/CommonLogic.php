<?php

class CommonLogic
{
    static function fetchAll(Request $request, string $modelName, bool $isArchived = false)
    {
        $modelLower = $isArchived ? str_replace('Archived', '', $modelName) : strtolower($modelName);

        eval("
            try {
                \${$modelLower} = {$modelName}::query(\"SELECT * FROM users INNER JOIN {$modelLower}s ON users.userId = {$modelLower}s.userId;\");

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

    static function fetchById(Request $request, string $modelName, bool $isArchived = false)
    {
        $modelLower = $isArchived ? str_replace('Archived', '', $modelName) : strtolower($modelName);

        eval("
            try {
                \$id = \$request->param[\"{$modelLower}Id\"];

                \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

                if (!\${$modelLower}) {
                    throw new PDOException(\"{$modelName} with Id {\$id} does not exist.\", 404);
                }

                http_response_code(200);
                return json([
                    '{$modelLower}' => \${$modelLower}
                ]);s

            } catch (PDOException \$e) {
                
                if (\$e->getCode() === 404) {
                    http_response_code(404);
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


    static function archiveHandler(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
                \$id = \$request->param['{$modelLower}Id'];

                \${$modelLower} = {$modelName}::find(['{$modelLower}Id' => \$id]);

                \$archived{$modelName} = new Archived{$modelName}(\${$modelLower});

                \$archived{$modelName}->save();

                \${$modelLower}->delete();

                http_response_code(200);
                return json([
                    'message' => 'Patient moved to archives.',
                    'patient' => \$archived{$modelName}
                ]);
            } catch (PDOException \$e) {

                http_response_code(500);
                return json([
                    'message' => \$e->getMessage()
                ]);
            }
        ");
    }

    static function deletePermanentHandler(Request $request, string $modelName)
    {
        $modelLower = strtolower($modelName);

        eval("
            try {
                \$id = \$request->param[\"{$modelLower}Id\"];

                \${$modelLower} = Archived{$modelName}::find(['{$modelLower}Id' => \$id]);
                
                if (!\${$modelLower}) {
                    throw new PDOException(\"Archived {$modelName} with Id of {\$id} does not exist.\", 404);
                }

                \$user = Archived{$modelName}::find(['userId' => \${$modelLower}->userId ]);

                \$user->delete();
                \${$modelLower}->delete();

                http_response_code(205);
                return json([
                    'message' => ' deleted successfully.',
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
}
