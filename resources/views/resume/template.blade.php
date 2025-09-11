<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    
    <style>
        body {
    font-family: Arial, sans-serif;
    height: fit-content;
    margin: 0;
    padding: 0;
   
}
p::first-letter{
 text-transform: uppercase;
}
.resume-container {
    margin: 20px auto;
    padding: 20px;
    background: white;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

header {
    text-align: center;
    color: #333;
}

h1 {
    margin-bottom: 5px;
}

.contact, .education, .experience, .skills, .projects {
    margin-top: 20px;
}

h2 {
    color: #555;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

ul {
    padding-left: 20px;
}
    </style>
</head>
<body>
    <div class="resume-container">
        <header>
            <h1>{{$data['user']}}</h1>
            <p>{{ $data['job'] }}</p>
        </header>
        <section class="contact">
            <h2>Contact</h2>
            <p>Email: {{$data['email']}}</p>
            <p>Phone: {{$data['cno']}}</p>
           @if (key_exists('web',$data))
            <p>  {{ "Website : ".$data['web']}}</p>
            @endif
        </section>
        <section class="education">
            <h2>Education</h2>
            @for ($i=0;$i<count($data['inst']);$i++)
               <p><strong>{{ $data['inst'][$i]}} -</strong>
              {{ $data['course'][$i]}}
              ({{ $data['year'][$i]}})
              {{ $data['per'][$i]}}
              </p> 
            
            @endfor  
        </section>
        @if (!empty($data['company']))
        <section class="experience">
            <h2>Work Experience</h2>
        @for ($i = 0; $i < count($data['company'][0]); $i++)
              <p><strong>{{ $data['company'][0][$i]}} Company</strong>
              {{ $data['company'][1][$i]}}
             <br /> {{ $data['company'][2][$i]}}
              </p>
@endfor
 </section>
 @endif
 
        <section class="skills">
            <h2>Skills</h2>

            <ul>
                @foreach ($data['skills'] as $skill)
                <li>{{ $skill }}</li>
                @endforeach
            </ul>
        </section>
        @if (!empty($data['project']))
        <section class="projects">
            <h2>Projects</h2>
             @for ($i = 0; $i < count($data['project'][0]); $i++)
              <p><strong>{{ $data['project'][0][$i]}} </strong>
              {{ $data['project'][1][$i]}}
              </p>
@endfor
            </section>
        @endif
    </div>
   
</body>
</html>

