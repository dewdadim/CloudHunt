<script setup lang="ts">
defineProps<{
  onComplete: () => void
}>()
</script>

<template>
  <div class="space-y-10 py-8">
    <div class="space-y-3">
      <h3 class="text-2xl font-bold">What is the Terminal</h3>
      <p>
        In the context of Linux, a terminal is a text-based interface for
        interacting with the operating system.
      </p>
      <p>
        It provides a command-line environment where users can enter commands
        directly to perform various tasks.
      </p>
      <p>
        Think of it as a window into the inner workings of the system, allowing
        direct control and access to system resources.
      </p>
    </div>
    <div class="space-y-3">
      <h3 class="text-2xl font-semibold">Role of the Terminal in Linux</h3>
      <ul class="list-disc space-y-2 pl-6">
        <li>
          <b>Primary Interface:</b> For many Linux users, the terminal is the
          primary method of interacting with the system.
        </li>
        <li>
          <b>System Administration:</b> It's the primary tool for system
          administrators to manage and configure the system, install software,
          troubleshoot issues, and perform advanced tasks.
        </li>
        <li>
          <b>Automation:</b> The terminal excels at automating repetitive tasks
          through scripting languages like Bash, Python, and Perl.
        </li>
        <li>
          <b>Software Development:</b> Developers use the terminal for tasks
          like compiling code, managing source code, running tests, and
          interacting with version control systems like Git.
        </li>
        <li>
          <b>Remote Access:</b> Tools like SSH allow users to access and control
          a Linux system remotely through a terminal connection.
        </li>
        <li>
          <b>Powerful Command-Line Tools:</b> A vast array of powerful
          command-line tools are available, providing unparalleled control and
          flexibility for tasks ranging from file manipulation to network
          administration.
        </li>
      </ul>
    </div>
  </div>
</template>
