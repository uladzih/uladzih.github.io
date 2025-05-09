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

<section>
  <h2>Day 0x03. Trasformations.</h2>
  <p>I've read the <a class="link" href="https://learnopengl.com/Getting-started/Transformations">"Transformations"</a> lesson and refreshed my linear algebra knowledge. The aricle covers the essentials of vectors, matrices, and their operations, and then maps these mathematical concepts to real-world transformations such as scaling, translating, and rotating objects. Later, the lesson demonstrates how to implement matrix transformations using the glm library. Since glm is designed for C++ and I use C, I picked the cglm library for my implementation:</p>
  
  <div class="snippet">mat4 model;
glm_mat4_identity(model);
    
vec3 translation_vec = {-.5f, -.5f, 0.f};
glm_translate(model, translation_vec);
    
vec3 rot_axis = {0.f, 0.f, 1.f};
glm_rotate(model, glfwGetTime(), rot_axis);
    
vec3 scale_vec = {.5f, .5f, 0.f};
glm_scale(model, scale_vec);</div>

  <video src="rotating.webm" controls loop class="horizontal">
  </video>
</section>

<section>
  <h2>Day 0x04. Coordinate Spaces.</h2>
  <p>
I've got acquainted myself with the <a class="link" href="https://learnopengl.com/Getting-started/Coordinate-Systems">"Coordinate Systems"</a> article. It explains what coordinate spaces are and how to transform vertices from one space to another. Essentially, each vertex goes through the following spaces:
  </p>
  
  <ul class="marked">
      <li>Local space</li>
      <li>World space (via the Model matrix)</li>
      <li>View space (via the View matrix)</li>
      <li>Clip space (via the Projection matrix)</li>
      <li>Screen space (via the internal Viewport transform)</li>
  </ul>
  
  <p>
The article then teaches two kinds of projection matrices: perspective and orthographic. Finally, it shows how coordinate spaces work in practice.
  </p>
  
  <p>
I've implemented all three kinds of matrices using the acquired knowledge and drawn the rectangle in perspective, slightly rotated:
  </p>
  
  <div class="snippet">mat4 model;
glm_mat4_identity(model);
vec3 rot_axis = {1.f, 0.f, 0.f};
glm_rotate(model, glm_rad(-60.f), rot_axis);
    
mat4 view;
glm_mat4_identity(view);
vec3 trans_vec = {0.f, 0.f, -2.f};
glm_translate(view, trans_vec);
    
mat4 proj;
glm_perspective(glm_rad(90.f), 8.f/6.f, 0.1f, 100.f, proj);</div>

  <img src="perspective.png" class="horizontal"/>
  
  <p>
In the end, I tried to turn the rectangle into a cube, but it went not so well. This happened because OpenGL doesn't enable z-buffer checking by default:
  </p>
  
  <img src="cube-no-buf.png" class="horizontal"/>
  
  <p>
These two simple lines fixed the problem:
  </p>
  
  <div class="snippet">glEnable(GL_DEPTH_TEST);</div>
  <div class="snippet">glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);</div>
  
  <img src="cube-with-buf.png" class="horizontal"/>
</section>

<section>
  <h2>Day 0x05. Things get interesting.</h2>
  
  <p>
I've skimmed through the <a class="link" href="https://learnopengl.com/Getting-started/Camera">"Camera"</a> chapter since it mainly talks about 3D concepts but I can't wait already to start my own 2D game. Instead, I've decided to peek in <a class="link" href="https://learnopengl.com/In-Practice/2D-Game/Breakout">"In Practice"</a> chapters and adapt something from them in my game.
  </p>
  
  <p>
This day I've started writing my own code. I've made resources module that compiles shader programs, reads and loads textures. For now, it provides two public functions: 
  </p>
  <div class="snippet">bool  res_create_shader(const char *vertex_file,
                        const char *fragment_file,
                        unsigned int *result_shader_id);

bool  res_create_texture(const char *texture_file,
                         unsigned int *result_texture_id);</div>

  <p>
This allowed me to unclutter a bit main.c module. Then, I've managed to draw semi-transparent textures properly using the following lines:
  </p>

  <div class="snippet">glEnable(GL_BLEND);
glBlendFunc(GL_SRC_ALPHA, GL_ONE_MINUS_SRC_ALPHA);</div>

  <p>
Now there are no more annoying black borders:
  </p>

  <img src="alpha-render.png" class="horizontal"/>

  <p>
Finally, I went for an evening walk to clear my mind and think about how to abstract sprite drawing process.
  </p>
</section>

<section>
  <h2>Day 0x06. Sprites.</h2>
  
  <p>
I am continuing to unclutter the main.c module while trying to find practical abstractions for sprites. My first attempt is to encapsulate everything needed for drawing a single object within a struct:
  </p>

  <div class="snippet">struct sprite {
    float x;
    float y;
    float width;
    float height;
    
    unsigned int vao;
    unsigned int shader;
    unsigned int tex;
};</div>

  <p>
Then, I created a function that initializes this struct:
  </p>
  
  <div class="snippet">static bool sprite_init(struct sprite *s) {
    s->vao = quad_init();
    
    if (!res_create_shader("shader.vs", "shader.fs", &s->shader)) {
        return false;
    }
    glUseProgram(s->shader);
    glUniform1i(glGetUniformLocation(s->shader, "tex"), 0);
    glUseProgram(0);
    
    if (!res_create_texture("armveh.png", &s->tex)) {
        return false;
    }

    s->x = 0.f;
    s->y = 0.f;
    s->width = 8.f;
    s->height = 4.f;
    
    return true;
}</div>

  <p>And drawing function:</p>

  <div class="snippet">static void sprite_draw(struct sprite *s) {
    glUseProgram(s->shader);
    
    int model_loc = glGetUniformLocation(s->shader, "model");
    int view_loc = glGetUniformLocation(s->shader, "view");
    int proj_loc = glGetUniformLocation(s->shader, "proj");
    
    mat4 model;
    glm_mat4_identity(model);
    vec3 pos_vec = {s->x, s->y, 0.f};
    glm_translate(model, pos_vec);
    vec3 scale_vec = {s->width, s->height, 0.f};
    glm_scale(model, scale_vec);
    
    mat4 view;
    glm_mat4_identity(view);
    
    glUniformMatrix4fv(
        model_loc, 1, GL_FALSE, (const GLfloat*) model
    );
    glUniformMatrix4fv(
        view_loc, 1, GL_FALSE, (const GLfloat*) view
    );
    glUniformMatrix4fv(
        proj_loc, 1, GL_FALSE, (const GLfloat*) game_state.proj_matrix
    );

    glActiveTexture(GL_TEXTURE0);
    glBindTexture(GL_TEXTURE_2D, s->tex);
    glBindVertexArray(s->vao);
    glDrawElements(GL_TRIANGLES, 6, GL_UNSIGNED_INT, 0);
    glBindVertexArray(0);
}</div>

  <p>
To test things, I am updating x and y coordinates inside loop and draw sprite:
  </p>

  <div class="snippet">while (!glfwWindowShouldClose(window)) {
    glfwPollEvents();
    process_input(window);
        
    glClearColor(0.2f, 0.3f, 0.3f, 1.0f);
    glClear(GL_COLOR_BUFFER_BIT);

    car.x += 0.025f;
    car.y += 0.025f;
    sprite_draw(&car);

    glfwSwapBuffers(window);
}</div>

  <p>
And it works!
  </p>

  <video src="sprite-move.mp4" class="horizontal" controls loop></video>
</section>
