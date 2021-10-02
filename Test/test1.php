<?php 
use Parle\Token;
use Parle\Lexer;
use Parle\LexerException;

/* name => id */
$token = array(
        "COMMA" => 1,
        "CRLF" => 2,
        "DECIMAL" => 3,
);
/* id => name */
$tokenIdToName = array_flip($token);

$lex = new Lexer();
$lex->push("[\x2c]", $token["COMMA"]);
$lex->push("[\r][\n]", $token["CRLF"]);
$lex->push("[\d]+", $token["DECIMAL"]);
$lex->build();

$in = "0,1,2\r\n3,42,5\r\n6,77,8\r\n";

$lex->consume($in);

do {
        $lex->advance();
        $tok = $lex->getToken();

        if (Token::UNKNOWN == $tok->id) {
                throw new LexerException("Unknown token '{$tok->value}' at offset {$lex->marker}.");
        }

        echo "TOKEN: ", $tokenIdToName[$tok->id], PHP_EOL;
} while (Token::EOI != $tok->id);


echo "hola"
?>