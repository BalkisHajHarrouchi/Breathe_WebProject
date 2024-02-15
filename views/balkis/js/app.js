// Selecting the necessary elements from the DOM
const chatBody = document.querySelector(".chat-body");
const txtinput = document.querySelector("#txtinput");
const send = document.querySelector(".send");
const loadingEle = document.querySelector(".loading");
const chatButton = document.querySelector(".chatButton");
const chatHeader = document.querySelector(".chat-header");
const container = document.querySelector(".chatcontainer");

// Hiding the chat container initially
container.style.display = "none";

// Initializing variables
let isShowChat = false;
let isShowIcon = true;

// Event listener for showing/hiding the chat container
chatButton.addEventListener("click", () => {
  if (!isShowChat) {
    container.style.display = "block";
    chatButton.style.display = "none";
    isShowChat = true;
  }
});

chatHeader.addEventListener("click", () => {
  if (isShowIcon) {
    container.style.display = "none";
    isShowChat = false;
    chatButton.style.display = "block";
  }
});

// Event listener for sending user message
send.addEventListener("click", () => renderUserMessage());

// Event listener for sending user message when Enter key is pressed
txtinput.addEventListener("keyup", (event) => {
  if (event.keyCode === 13) {
    renderUserMessage();
  }
});

// Function to render user message
const renderUserMessage = () => {
  const userInput = txtinput.value;
  renderMessageEle(userInput, "user");
  txtinput.value = "";
  toggleLoading(false);
  renderChatbotResponse(userInput);
  // console.log(renderChatbotResponse(userInput));
  
};

// Function to render chatbot response
const renderChatbotResponse = (userInput) => {
  const res = getChatbotResponse(userInput);
  
};

// Function to render message elements
const renderMessageEle = (txt, type) => {
  let className = "user-message";
  const messageEle = document.createElement("div");
  const txtNode = document.createTextNode(txt);
  
  messageEle.append(txtNode);
  if (type !== "user") {
    // console.log(txtNode);
      
    className = "chatbot-message";
    messageEle.classList.add(className);
    const botResponseContainer = document.createElement("div");
    botResponseContainer.classList.add("bot-response-container");
    const botImg = document.createElement("img");
    botImg.setAttribute("src", "../balkis/img/chatbot.png");
    botResponseContainer.append(botImg);
    botResponseContainer.append(messageEle);
    chatBody.append(botResponseContainer);
  } else {
    messageEle.classList.add(className);
    chatBody.append(messageEle);
  }
};

// Function to get chatbot response
const getChatbotResponse = (userInput) => {
  chatBotService
    .getBotResponse(userInput)
    .then((response) => {
      renderMessageEle(response);
      // ***************
      console.log(response);

      if(response !== ""){
        if(!synth.speaking){
            textToSpeech(response);
        }
        if(response.length > 80){
            setInterval(()=>{
                if(!synth.speaking && !isSpeaking){
                    isSpeaking = true;
                    // speechBtn.innerText = "Convert To Speech";
                }else{
                }
            }, 500);
            if(isSpeaking){
                synth.resume();
                isSpeaking = false;
                speechBtn.innerText = "Pause Speech";
            }else{
                synth.pause();
                isSpeaking = true;
                speechBtn.innerText = "Resume Speech";
            }
        }else{
            // speechBtn.innerText = "Convert To Speech";
        }
    }

      setScrollPosition();
      toggleLoading(true);
      
    })
    .catch((error) => {
      setScrollPosition();
      toggleLoading(true);
    });
    
};

// Function to set the scroll position to the bottom of the chat container
const setScrollPosition = () => {
  if (chatBody.scrollHeight > 0) {
    chatBody.scrollTop = chatBody.scrollHeight;
  }
};

// Function to toggle loading animation
const toggleLoading = (show) => loadingEle.classList.toggle("hide", show);

// Object containing chatbot responses
const responseObj = {
  hello: "Hey ! How are you doing ?",
  hey: "Hi ! How can I help you?",
  today: new Date().toDateString(),
  time: new Date().toLocaleTimeString(),
  "i love you":"i love you too and i'm here for you!",
  "find":"you can find a coach by using the search bar or you can put his information in the groupbox situated in the table",
  abc:"a b c d e f g h i j k l m n o p q r s t u v w x y z this is the alphabet if you need it ",
  help:"How can i assist you today?",
  participate:"You can check the events list and find multiple categories and types",
  search:"on the top of the page you can find a search bar which will help you find the events you want to search",
  shit:"Bad words are disrespectful!",
  "fuck you":"How dare you! Please Do not use cursing words it can hurt others like it did to me!",
  fuck:"Do not use cursing words this is a public website!",
  "you are sweet":"Arigato! Don't tell the others i'm only this sweet with you",
  "":"Did you know?The First Computer Weighed More Than 27 Tons",
  " ":"Did you know?Hackers Write About 6,000 New Viruses Each Month",
  "who are you?":"Hi I'm Bemo your assistant.I can help you discover our website!",
  "thanks":"You are welcome !Don't hesitate to ask if you have any other questions",
  "thank you":"That is my duty.I'm here if you need me :)",
};

// Function to fetch response from the response object
const fetchResponse=(userInput)=>{
    return new Promise((res,reject)=>{
        try{
            setTimeout(()=>{
                res(responseObj[userInput]);
            },1200);
            
        }catch(error){
            reject(error);
        }
    });

};
const chatBotService = {
    getBotResponse(userInput){
        return fetchResponse(userInput);
    },
};
// ******************************************
// ******************************************
// ******************************************





const voiceList = document.querySelector("select"),
speechBtn = document.querySelector("button");

let synth = speechSynthesis,
isSpeaking = true;

voices();

function voices(){
    for(let voice of synth.getVoices()){
        let selected = voice.name === "Google US English" ? "selected" : "";
        let option = `<option value="${voice.name}" ${selected}>${voice.name} (${voice.lang})</option>`;
        
        voiceList.insertAdjacentHTML("beforeend", option);
    }
}

synth.addEventListener("voiceschanged", voices);


let isMuted = false;
const muteButton = document.getElementById("mute");
const muteImg = document.getElementById("muteBtn");

muteButton.addEventListener('click', () => {
  isMuted = !isMuted;
  if (isMuted) {
    muteImg.setAttribute("src", "../balkis/img/mute.png");
  } else {
    muteImg.setAttribute("src", "../balkis/img/volume.png");
  }
});

function textToSpeech(text) {
  // console.log("yes");
  // console.log(isMuted);
  let utterance = new SpeechSynthesisUtterance(text);
  for (let voice of synth.getVoices()) {
    if (voice.name === voiceList.value) {
      utterance.voice = voice;
    }
  }

  if (isMuted) {
    synth.cancel(); // stop speaking if the mute flag is set
  } else {
    synth.speak(utterance);
  }
}

const recordBtn = document.getElementById("click_to_record");
recordBtn.addEventListener('click',function(){
  var speech = true;
  window.SpeechRecognition = window.webkitSpeechRecognition;

  const recognition = new SpeechRecognition();
  recognition.interimResults = true;

  recognition.addEventListener('result', e => {
      const transcript = Array.from(e.results)
          .map(result => result[0])
          .map(result => result.transcript)
          
          // txtinput.value="nemchi jawi behy";
          txtinput.value = transcript;
          console.log(transcript);
  });
  
  if (speech == true) {
      recognition.start();
  }
})