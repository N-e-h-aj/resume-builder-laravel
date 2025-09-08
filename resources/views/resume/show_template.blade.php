@include('resume.template',compact('data'))
<div>
<style>
    
form{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
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
    }</style>    
<form action="{{Route('resume.generate',compact('data'))}}" method="post">
@csrf    

<button>Download</button>
</form></div>