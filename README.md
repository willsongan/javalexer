# javalexer
Lexer for java language with limited token range. This program scans and print out scanned tokens.

the only java program I have scanned is source code below

class Main {
    public static void main (String[] args) {
  
      int num = 1234, reversed = 0;
  
      while(num != 0) {    
        int digit = num % 10;
        reversed = reversed * 10 + digit;
        num /= 10;
      }
    }
  }
  
