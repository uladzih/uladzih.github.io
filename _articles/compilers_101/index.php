<section>
  <h1 id="compiler-structure">Compilers 101</h1>

  <ul>
    <li><a class="link" href="#the-meaning-of-life">The meaning of life</a></li>
    <li><a class="link" href="#programming-languages">Programming Languages</a></li>
    <li><a class="link" href="#compilers-to-the-rescue">Compilers to the rescue</a></li>
    <li><a class="link" href="#lexical-analysis">Lexical analysis</a></li>
    <li><a class="link" href="#syntax-analysis">Syntax analysis</a></li>
    <li><a class="link" href="#semantic-anaysis">Semantic analysis</a></li>
    <li><a class="link" href="#code-optimization">Code optimization</a></li>
    <li><a class="link" href="#code-generation">Code generation</a></li>
    <li><a class="link" href="#t-diagrams">T-Diagrams</a></li>
    <li><a class="link" href="#bootstrapping">Bootstrapping</a></li>
    <li><a class="link" href="#compiler-retargeting">Compiler retargeting</a></li>
  </ul>

</section>

<section>
  <h2 id="the-meaning-of-life">The meaning of life</h2>
  <p>
    If hardware were flesh and bones, programs would be mind and soul. Therefore, software gives life to hardware.
    But what do the programs actually look like?
  </p>
  <p>
    They are simply a series of ones and zeros in the computer's memory, representing a sequence of instructions.
    For example, the following binary sequence could be an instruction to move data to a register:
  </p>
  <div class="snippet">10100000</div>
  <p>
    However, this format is difficult for humans to understand.
    Moreover, computer instructions are limited to basic tasks like adding numbers or storing values in memory.
    And there is no direct instruction to draw a circle on the screen or send files over the network.
    To simplify the creation of software, programming languages were invented.
  </p>
</section>

<section>
  <h2 id="programming-languages">Programming Languages</h2>
  <p>
    Programming languages help to describe algorithms in a human-friendly form.
    They eliminate the flaws of direct programming in machine code.
    First, they define operations at a higher level of abstraction.
    For example, the majority of languages support procedure definitions.
  </p>
  <p>
    A procedure is a named sequence of instructions that perform a more complicated task 
    than individual instructions.
    For instance, one can define a procedure that counts from 0 up to any number:
  </p>
  
<div class="snippet">procedure count(n) {
    for i = 0 to n {
        print i;
    }
}</div>

    <p>And then, one can use this procedure as a basic operation without caring about its internals:</p>
    
<div class="snippet">count(10);
count(5);</div>

    <p>In addition, programming languages abstract away from the differences between hardware architectures. They aim
    to be platform independent. Once you have written an algorithm in the programming language, it can be run
    on different types of hardware. This allows you to fully focus on the software implementation
    without worrying about the number of registers or stack allocation.</p>

    <p>All right, it's fine and dandy, but there's one detail missing: computers don't underestand our fictional programming languages.</p>
</section>

<section>
    <h2 id="compilers-to-the-rescue">Compilers to the rescue</h2>
    <p>Someone has to convert programs written in a programming language into machine code.
    This task can be done by another program called a compiler. The compiler takes a text file written in the programming language and translates it into a binary file consisting of machine codes.</p>
    
    <p>The compilation process involves a number of stages that gradually transform the program into a more machine-readable format. Almost all compilers perform these steps:</p>
    
    <ul class="marked">
        <li>Lexical analysis</li>
        <li>Syntax analysis</li>
        <li>Semantic analysis</li>
        <li>Code optimization</li>
        <li>Code generation</li>
    </ul>
</section>

<section>
    <h2 id="lexical-analysis">Lexical analysis</h2>
    <p>The lexical analysis component is sometimes called a scanner.
    During this step, the compiler reads characters from the source text
    one by one and groups them into tokens.
    It skips whitespaces and comments because these have no meaning
    in the rest of the compilation process.
    The sequence of tokens then proceeds to the syntax analysis phase.</p>
    
    <p>A token is usually represented by a number.
    For example, each time the scanner encounters the word 'while', it may return the number '7'.
    Similarly, when reading the left brace '{', it may produce the number '9'.
    The specific value of these numbers is not critical, as long as they remain consistent for each token type.</p>
    
    <p>The purpose of this step is to simplify input for the rest of the compiler.
    Manipulating token numbers is easier than handling variable-length strings.</p>
</section>

<section>
    <h2 id="syntax-analysis">Syntax analysis</h2>
    <p>The syntax analysis part can be referred to as a parser.
    This step matches the actual token sequence with syntax rules and groups them accordingly.
    While doing this, the parser also finds syntax errors and outputs them for users to correct.</p>
    <p>A language may have a syntax rule for expressions.
    This rule may define expressions as two numbers followed by an operator:</p>
    <div class="snippet">expression -> number number operator</div>
    <p>So, the parser must somehow mark two consecutive numbers and an operator as part of the 'expression' rule.
    For example, the parser could encounter the following token sequence:</p>
    <div class="snippet">'{' '9' '3' '+' 'while'</div>
    <p>In this case, it would group the tokens '9' '3' '+' as part of the 'expression':</p>
<div class="snippet">     / expression \
'{'  | '9' '3' '+' |  'while'</div>
    <p>Parsers usually use tree data structures to group tokens, and then pass the grouped tokens to the semantic analysis step.</p>
</section>

<section>
    <h2 id="semantic-anaysis">Semantic analysis</h2>
    <p>The semantic analysis stage checks the meaning of the program. It inspects declarations
    and ensures type consistency. For example, a program may declare a string variable and
    try to use it in an arithmetic expression, which is meaningless:</p>
<div class="snippet">var str: string = "String literal";
var num: integer = 42;
num - str; // <- Type error!</div>
    <p>If the program passes this stage, the compiler will move on to the optimization phase.</p>

</section>

<section>
    <h2 id="code-optimization">Code optimization</h2>
    <p>The compiler can sometimes optimize source code without changing its intended logic.
    There are many robust optimization techniques available. For example, one of the simplest optimizations
    is constant folding. It precalculates expressions whose operands are known at compile time:</p>
    <div class="snippet">a = 3 * 4 + 2; -becomes-> a = 14;</div>

</section>

<section>
    <h2 id="code-generation">Code generation</h2>
    <p>During this stage, the compiler finally outputs code for a target machine. The target machine can be
    real hardware or some abstraction like another compiler that accepts the generated code as a source program.</p>
    <p>Sometimes, the code generation does not complete the compilation process.
    Target code optimization steps may occur that output more compact or faster code variants.</p>
</section>

<section>
    <h2 id="t-diagrams">T-Diagrams</h2>

    <p>Compilers are depicted graphically using T-diagrams. The T-diagram looks like this:</p>

    <img src="t-diagram.png" alt="T-Diagram" class="horizontal"/>

    <p>The base language is the programming language in which the compiler is written.</p>

    <p>Let's take a look at a real-world example: a Rust-based translator that converts
    TypeScript source code into JavaScript. The T-diagram for this is as follows:</p>

    <img src="t-diagram-real.png" alt="T-Diagram Example" class="horizontal"/>

    <p>But the computer does not understand Rust source code. Therefore, another compiler converts the Rust-based translator into executable machine code. After that, the Rust-based translator becomes machine-code-based, which means it runs directly on the computer:</p>
    
    <img src="t-diagram-trans-1.png" alt="T-Diagram Base Conversion" class="horizontal"/>

    <p>Also, a compilation output can serve as input for another compiler. In the context of our example,
    a Rust-based compiler uses previously generated JavaScript code to produce WebAssembly:</p>

    <img src="t-diagram-trans-2.png" alt="T-Diagram Output Conversion" class="horizontal"/>

    <p>T-diagrams help to understand cross-compilation and the bootstrapping process,
    which are widely used by language implementors.</p>
</section>

<section>
    <h2 id="bootstrapping">Bootstrapping</h2>

    <p>It is common to implement a compiler using the same language it compiles:</p>
    
    <img src="self-compiling.png" alt="Self-compiling compiler" class="horizontal"/>
    
    <p>This kind of compiler is called self-compiling.
    The optimizations made in them
    improve not only the programs they output, but also
    the compilers themselves.</p>
    
    <p>However, it is a chicken-and-egg situation.
    At the start, the compiler does not exist,
    and the 'new' language can't be compiled:</p>
    
    <img src="self-compiling-problem.png" alt="Self-compiling problem" class="horizontal"/>
    
    <p>So, the first unoptimized and cut version of
    the compiler is written in another 'old' language.
    It may output extremely inefficient code, but its sole
    purpose is to produce the full compiler
    written in its own 'new' source language:</p>
    
    <img src="bootstrapping-1.png" alt="Bootstrapping Step 1" class="horizontal"/>
    
    <p>The full but inefficient compiler outputs efficient code.
    So, it is used to produce the full and efficient final
    version of the compiler:</p>
    
    <img src="bootstrapping-2.png" alt="Bootstrapping Step 2" class="horizontal"/>
    
    <p>The full process mentioned before is called compiler bootstrapping.</p>
</section>

<section>
    <h2 id="compiler-retargeting">Compiler retargeting</h2>

    <p>The self-compiling compiler can be easily retargeted
    to run on a different computer architecture.
    Firstly, the code generation part must be rewritten and recompiled.
    This results in a cross-compiler that runs on
    the original machine, but outputs code for another machine:</p>
    
    <img src="retarget-1.png" alt="Retargeting Step 1" class="horizontal"/>
    
    <p>Lastly, the cross-compiler compiles itself to produce a
    compiler that runs on another machine:</p>
    
    <img src="retarget-2.png" alt="Retargeting Step 2" class="horizontal"/>
</section>

