<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10118115_WILLSON</title>
</head>
<body>
    <h1>PHP LEXER UNTUK JAVA</h1>
    <b>Kelompok 5</b>
    <table>
        <tr><td>Nama<td>NIM
        <tr><td>1. Willson <td> 10118115
        <tr><td>2. Saint Fredly <td> 10118090
        <tr><td>3. Muhammad Aulia Rahman <td> 10118111
        <tr><td>4. Rendi Gunawan <td> 10118131
        <tr><td>5. Mohammad Alfan <td> 10118134
    </table>
    <form action="10118115_Willson.php" method="post">
        Source code: <br>
        <textarea name="javacode" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="submit">
    </form>

<hr>
<?php
class Lexer
{
    protected static $tokens = [
        'T_KEYWORD' => '/\s*\b(class|main|public|static|void|main|int|while|String|args)\b/',
        'T_SEPARATOR' => '/\s*([\[\]\(\)\{\}\,\=\;\.])/',
        'T_OPERATOR' => '/\s*([\+\-\/\*\%\!])/',
        'T_LITERAL' => '/\s*([\d])/',
        'T_IDENTIFIER' => '/\s*([^ \t\r\n\v\f\[\]\(\)\{\}\,\=\;\.\+\-\/\*\%\!]+)(\s*|$)/',
    ];
    /*
    Token for keyword : class,main,public,static,void,main,int,while,String,args
    Token for separator : [](){},=;.
    Token for operator : +-/*%!
    Token for literal : 0-9
    Token for identifier : all except keyword, separator, operator, literal
    */

    public function tokenize($subject)
    {
        $tokens = [];

        $offset = 0;
        while ($offset < strlen($subject)) {
            $token = $this->match(substr($subject, $offset));
            if (false === $token) {
                throw new Exception(sprintf('Unable to parse subject "%s"', $subject));
            }
            $offset += $token['size'];
            $tokens[] = [$token['token'] => $token['match']];
        }

        return $tokens;
    }

    public function match($subject)
    {
        foreach (self::$tokens as $name => $pattern) {
            $matches = [];
            if (1 === preg_match($pattern.'A', $subject, $matches)) {
                return [
                    'size' => strlen($matches[0]),
                    'match' => $matches[1],
                    'token' => $name,
                ];
            }
        }

        return false;
    }
}

$lexer = new Lexer();
$kodeinputan = isset($_POST['javacode']) ? $_POST['javacode'] : '';

echo "<pre>";
echo "<table>";
echo "<tr><td>Lexeme<td>Token";
if(isset($kodeinputan)){
    foreach ($lexer->tokenize($kodeinputan) as $key => $value) {
        if(isset($value['T_IDENTIFIER'])) echo "<tr><td>",$value['T_IDENTIFIER'], "<td>Identifier";
        if(isset($value['T_LITERAL'])) echo "<tr><td>",$value['T_LITERAL'], "<td>Literal";
        if(isset($value['T_OPERATOR'])) echo "<tr><td>",$value['T_OPERATOR'], "<td>Operator";
        if(isset($value['T_SEPARATOR'])) echo "<tr><td>",$value['T_SEPARATOR'], "<td>Separator";
        if(isset($value['T_KEYWORD'])) echo "<tr><td>",$value['T_KEYWORD'], "<td>Keyword";
    }
}
echo "</table>";
echo "</pre>";
?>
</body>
</html>
