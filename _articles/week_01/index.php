<section>
  <h1>Week 0x01</h1>
  <h2>Day 0x07. Animated sprites.</h2>
  <p>
  I continue looking for the perfect code architecture and data structures. I've created a render module that implements drawing capabilities and abstracts low-level OpenGL calls.
  </p>
  <p>
  While reviewing the code, I came to the conclusion that it wasn't necessary to store the shader identifier and VAO object in each sprite, since they are the same for all sprites. So, I moved those fields into a common render structure that will store the global rendering state.
  </p>
  <p>
Then I was thinking about how to implement animated sprites. I realized that the vertex attributes could store UV coordinates for the first frame, and I could pass the frame index via uniforms. Finally, the vertex shader could scale the UV coordinates using the frame index. The idea worked out perfectly:
  </p>
  
  <video src="animated-sprite.mp4" class="horizontal" controls loop></video>
  
  <p>
  Finally, I've rewritten the game loop to update <a class="link" href="https://gafferongames.com/post/fix_your_timestep/">using a fixed timestep</a>:
  </p>
  
  <div class="snippet">int delta_acc = 0;
double lastTime = glfwGetTime();
while (!glfwWindowShouldClose(window)) {
    double startTime = glfwGetTime();
    delta_acc += (int) ((startTime - lastTime) * 1000);
    lastTime = startTime;
 
    glfwPollEvents();
    process_input(window);
        
    while (delta_acc >= SIM_DT_MS) {
        render_update(&game.render, &game.objs, SIM_DT_MS);
        delta_acc -= SIM_DT_MS;
    }
      
    render_erase(&game.render);
    render_draw(&game.render, &game.objs);
        
    glfwSwapBuffers(window);
}</div>
  <p>
  This kind of loop is a best practice in game programming, especially in multiplayer games. In short, it uses a variable that accumulates elapsed time. The accumulated time is then compared against a fixed simulation delta time. When the accumulated time exceeds the delta time, the update step is executed, and the simulation delta is subtracted from the accumulator variable.
  </p>
</section>

<section>
  <h2>Day 0x08. Loading sprites.</h2>
  <p>I've implemented animated sprites, but their data was previously hardcoded. Today, I've fixed this by creating a sprite sheet resource file format and writing a loader for it.
  </p>
  <p>
One image can store multiple sprite animation frames, and sprites may have different dimensions. So, there should be means to store information such as the number of frames and their arrangement on the image. The simplest approach is to use a regular text file. I've decided to store the file with .info extension alongside the sprite image. For example, I have the image with banknote animation frames:
  </p>
  
  <img src="sprite-sheet.png" class="horizontal"/>
  
  <p>
It contains 7 frames, 32х32 pixels each, therefore banknote.info has the following information:
  </p>
  
  <div class="snippet">7 32 32

default
0:150 1:125 2:100 3:75 4:150 5:150 6:150 5:150 4:150 3:150 2:150 1:150</div>

  <p>
The first line specifies the frame count and their dimensions. The third line contains the animation name, and the fourth line lists the frame sequence in the following format: 
  </p>
  <div class="snippet">frame index:frame duration</div>
  <p>
I've written a simple parser, around 150 lines, that reads .info files and populates the render data structures.
  </p>
  <p>
Now the game can use arbitrary sprites and animations without recompilation.
  </p>
</section>
