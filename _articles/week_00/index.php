<section>
  <h1>Week 0x00</h1>

  <h2>Day 0x00. Drawing Triangles.</h2>
  <p>
OpenGL is a library for creating three-dimensional graphics. I used it a long time ago, and I haven't done anything particularly interesting. Therefore, it can be considered that I am starting my journey from scratch.
  </p>

  <p>
I remember that there are two main modes in OpenGL: the old one, called immediate mode, and the new core-profile mode. In modern development, it's advised not to use immediate mode because it is slow, outdated, and removed from the latest versions of OpenGL. However, it is simpler and easier to start drawing with. On the other hand, core-profile mode works faster, is closer to the hardware, and therefore more complex.
  </p>

  <p>
Without any doubt, I decided to use the core-profile mode. Many posts and blogs on the Internet refer to the site <a class="link" href="https://learnopengl.com/">learnopengl.com</a> as the best resource for learning modern OpenGL, so I started with it.
  </p>

  <p>
The first lessons explain the basic foundation and principles of how OpenGL works from a high-level perspective, and also describe how to install the necessary libraries to start programming. I didn't encounter any particular problems with this since I already have extensive experience programming in C and understand the basic principles. As a result, I managed to render a simple window.
  </p>
  
  <p>
I quickly moved on to the <a class="link" href="https://learnopengl.com/Getting-started/Hello-Triangle">"Hello Triangle"</a> lesson, which describes how to draw a triangle. At this point, I had to pay close attention. The lesson explained everything: the structure of the rendering pipeline, the coordinate system, vertex buffers, shaders, and so on. And all of this just to draw one simple triangle!
  </p>
  
  <p>
Initially, the triangle simply refused to appear on the screen. But I quickly realized that the reason was that I had changed the function's prototype to return a buffer index instead of setting it via a pointer in the parameter. In other words, I originally wrote the function as:
  </p>
  
  <div class="snippet">void triangle_init(unsigned int *VAO) {...}</div>

  <p>
and called it like this:
  </p>

  <div class="snippet">triangle_init(&VAO);</div>
  <p>
Later, I changed the prototype to:
  </p>
<div class="snippet">unsigned int triangle_init() {...}</div>
  <p>
but didn't change the call:
  </p>
<div class="snippet">triangle_init(&VAO);</div>
  <p>
The C compiler doesn't forbid passing parameters to functions with an empty parameter list and doesn't produce an error. Therefore, the correct declaration should have been:
  </p>
<div class="snippet">unsigned int triangle_init(void) {...}</div>
  <p>
After all the corrections, the triangle finally appeared. After that, the lesson shows how to draw a rectangle from two triangles using an element buffer object. There were no issues with that part:
  </p>
  <img src="rect.png" class="horizontal"/>
  <p>
I must admit, it wasn't easy, but I'm glad that everything worked out!
  </p>
</section>

<section>
  <h2>Day 0x01. Shaders.</h2>
  
  <p>
I've read the <a class="link" href="https://learnopengl.com/Getting-started/Shaders">"Shaders"</a> lesson. It explains GLSL, the programming language for shaders, and then guides through simple vertex and fragment shader implementations. It shows how to compile and link shader program. After that, the lesson introduces the concept of uniforms, which allow an application to pass data to shader programs in real time. For example, here I used a uniform to dynamically change the color of the rectangle:
  </p>
  
  <video src="changing-colors.webm" controls loop class="horizontal">
  </video>
  
  <p>
  Next, the lesson demonstrates fragment interpolation and provides additional information on vertex attributes. This knowledge enabled me to add this beautiful gradient effect:
  </p>
  
  <img src="interpolation.png" class="horizontal"/>
  
  <p>
  Finally, the lesson suggested creating your own shader class. I don't personally like the idea of a single property encapsulation, and since I use C — a language that doesn't support classes — I implemented just a couple of functions that read shader source files and compile them into a shader program.
  </p>
</section>

<section>
  <h2>Day 0x02. Textures.</h2>
  
  <p>I've completed the <a class="link" href="https://learnopengl.com/Getting-started/Textures">"Textures"</a> lesson and successfully drawn a texture on my rectangle:
  </p>
  
  <img src="textured.png" class="horizontal"/>
  
  <p>I've also learned more about texture coordinates, texture wrapping and filtering, mipmaps, and using textures in shaders.
  </p>
</section>
