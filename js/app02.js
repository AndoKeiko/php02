



// async function sendToChatGPT() {
//   const inputText = document.getElementById('inputText').value;
//   const responseElement = document.getElementById('responseText');

//   try {
//       const response = await fetch('https://api.openai.com/v1/engines/davinci-codex/completions', {
//           method: 'POST',
//           headers: {
//               'Content-Type': 'application/json',
//               'Authorization': 'Bearer YOUR_API_KEY_HERE'  // ここにあなたのAPIキーを入れてください
//           },
//           body: JSON.stringify({
//               prompt: inputText,
//               max_tokens: 150
//           })
//       });

//       if (!response.ok) {
//           throw new Error('API request failed');
//       }

//       const data = await response.json();
//       responseElement.textContent = data.choices[0].text;
//   } catch (error) {
//       console.error('Error:', error);
//       responseElement.textContent = 'エラーが発生しました。';
//   }
// }