<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resume Builder</title>
  <style>

    /* General Reset */
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    /* Form Container */
    form {
      width: 100%;
      max-width: 650px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    /* Fieldsets */
    fieldset {
      display: none;
      border: none;
      padding: 0;
    }

    fieldset.active {
      display: block;
      animation: fadeIn 0.3s ease-in-out;
    }

    /* Inputs and Labels */
    label {
      font-weight: 600;
      color: #333;
      margin-bottom: 4px;
    }

    input,
    textarea {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin: 0.5rem 0 1rem 0;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }

    input:focus,
    textarea:focus {
      border-color: #4a90e2;
      outline: none;
    }

    /* Grouped Items (Education, Experience, etc.) */
    .group {
      background: #f9f9f9;
      border: 1px solid #ddd;
      padding: 15px;
      margin-bottom: 1rem;
      border-radius: 8px;
      position: relative;
    }

    /* Remove Button */
    button.remove {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #ff4d4d;
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 0.85rem;
    }

    button.remove:hover {
      background: #e60000;
    }

    /* 📊 Progress Bar */
    #progress {
      height: 12px;
      background: #e0e0e0;
      border-radius: 6px;
      margin-bottom: 30px;
      overflow: hidden;
    }

    #progress-bar {
      height: 100%;
      width: 0%;
      background: linear-gradient(to right, #4a90e2, #7ed6df);
      transition: width 0.4s ease;
    }

    /* 🎛️ Navigation Buttons */
    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 1.5rem;
    }

    button {
      background: #4a90e2;
      color: white;
      padding: 10px 20px;
      font-size: 1rem;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #357ab7;
    }

    /* ✨ Animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>

  <form id="resumeForm" action="{{ Route('resume.show') }}" method="post">
    @csrf
    <h2>Build Your Resume</h2>
    <div id="progress">
      <div id="progress-bar"></div>
    </div>

    <!-- Step 1: Personal Info -->
    <fieldset class="active">
      <legend>Personal Information</legend>
      <input type="text" name="user" placeholder="Your Name" required>
      <input type="text" name="job" placeholder="Job title" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="cno" placeholder="Contact No" required>
      <input type="text" name="objective" placeholder="Objective" required>
      <div class="buttons">
        <button type="button" class="next">Next</button>
      </div>
    </fieldset>

    <!-- Step 2: Education -->
    <fieldset>
      <legend>Education
        <button type="button" onclick="addMore('edu-template', 'edu-container')">+ Add</button>
      </legend>
      <div id="edu-container">
        <div class="group">
          <input type="text" name="inst[]" placeholder="Institute Name" required>
          <input type="text" name="course[]" placeholder="Course Name" required>
          <input type="text" name="per[]" placeholder="Percentage/CGPA" required>
          <input type="text" name="year[]" placeholder="Year" required>
        </div>
      </div>
      <div class="buttons">
        <button type="button" class="prev">Prev</button>
        <button type="button" class="next">Next</button>
      </div>
    </fieldset>

    <!-- Step 3: Experience -->
    <fieldset>
      <legend>Experience
        <button type="button" onclick="addMore('exp-template', 'exp-container')">+ Add</button>
      </legend>
      <div id="exp-container">
        <div class="group">
          <input type="text" name="company[0][]" placeholder="Company Name">
          <input type="text" name="company[1][]" placeholder="Position" >
          <textarea name="company[2][]" placeholder="Description"></textarea>
        </div>
      </div>
      <div class="buttons">
        <button type="button" class="prev">Prev</button>
        <button type="button" class="next">Next</button>
      </div>
    </fieldset>
    <!-- Step 3: Project -->
    <fieldset>
      <legend>Project
        <button type="button" onclick="addMore('pro-template', 'pro-container')">+ Add</button>
      </legend>
      <div id="pro-container">
        <div class="group">
          <input type="text" name="project[0][]" placeholder="Institute Name" required>
          <input type="text" name="project[1][]" placeholder="Course Name" required>
           </div>
           </div>
        <div class="buttons">
          <button type="button" class="prev">Prev</button>
          <button type="button" class="next">Next</button>
        </div>
    </fieldset>
    <!-- Step 4: Skills -->
    <fieldset>
      <legend>Skills
        <button type="button" onclick="addMore('skill-template', 'skill-container')">+ Add</button>
      </legend>
      <div id="skill-container">
        <input type="text" name="skills[]" placeholder="Skill" required>
      </div>
      <div class="buttons">
        <button type="button" class="prev">Prev</button>
        <button type="submit">Submit</button>
      </div>
    </fieldset>
  </form>

  <!-- Templates -->
  <template id="edu-template">
    <div class="group">
      <input type="text" name="inst[]" placeholder="Institute Name" required>
      <input type="text" name="course[]" placeholder="Course Name" required>
      <input type="text" name="per[]" placeholder="Percentage/CGPA" required>
      <input type="text" name="year[]" placeholder="Year" required>
      <button type="button" class="remove" onclick="removeSection(this)">Remove</button>
    </div>
  </template>

  <template id="exp-template">
    <div class="group">
      <input type="text" name="company[0][]" placeholder="Company Name" required>
      <input type="text" name="company[1][]" placeholder="Position" required>
      <textarea name="company[2][]" placeholder="Description" required></textarea>
      <button type="button" class="remove" onclick="removeSection(this)">Remove</button>
    </div>
  </template>
  <template id="pro-template">
    <div class="group">
      <input type="text" name="project[0][]" placeholder="Project Title" required>
      <input type="text" name="project[1][]" placeholder="Description" required>
      <button type="button" class="remove" onclick="removeSection(this)">Remove</button>
    </div>
  </template>

  <template id="skill-template">
    <div class="group">
      <input type="text" name="skills[]" placeholder="Skill" required>
      <button type="button" class="remove" onclick="removeSection(this)">Remove</button>
    </div>
  </template>

  <script>
    const fieldsets = document.querySelectorAll("form fieldset");
    let currentStep = 0;

    function updateStep() {
      fieldsets.forEach((fs, i) => {
        fs.classList.toggle("active", i === currentStep);
      });
      document.getElementById("progress-bar").style.width = ((currentStep) / (fieldsets.length - 1)) * 100 + "%";
    }

    document.querySelectorAll(".next").forEach(btn => {
      btn.addEventListener("click", () => {
        if (currentStep < fieldsets.length - 1) {
          currentStep++;
          updateStep();
        }
      });
    });

    document.querySelectorAll(".prev").forEach(btn => {
      btn.addEventListener("click", () => {
        if (currentStep > 0) {
          currentStep--;
          updateStep();
        }
      });
    });

    function addMore(templateId, containerId) {
      const template = document.getElementById(templateId);
      const container = document.getElementById(containerId);
      const clone = template.content.cloneNode(true);
      container.appendChild(clone);
    }

    function removeSection(button) {
      const section = button.closest(".group");
      if (section) section.remove();
    }

    updateStep(); // Initialize
  </script>

</body>

</html>