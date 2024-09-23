<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Söz Dəyişdirici</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .result {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Söz Dəyişdirici</h2>
    <form id="sentenceForm" method="POST">
        <label for="sentence">Cümləni daxil edin:</label>
        <input type="text" id="sentence" name="sentence" required>
        <button type="button" onclick="processSentence()">Dəyişdir</button>
    </form>
    <div class="result" id="result"></div>
</div>

<script>
    // Spesifik sözlər siyahısı
    const wordsToMask = ['alma', 'armud', 'heyva'];

    // Funksiya daxil edilən cümlədə sözü dəyişdirir
    function maskWord(word) {
        if (word.length > 2) {
            let firstLetter = word[0];
            let lastLetter = word[word.length - 1];
            let middlePart = '*'.repeat(word.length - 2);
            return firstLetter + middlePart + lastLetter;
        }
        return word; // Əgər söz 2 hərfdən kiçikdirsə, olduğu kimi qaytar
    }

    function processSentence() {
        let sentence = document.getElementById('sentence').value;
        let words = sentence.split(' '); // Cümləni sözlərə ayırırıq

        // Hər bir sözü yoxlayırıq, əgər müəyyən edilmiş sözlərdən biridirsə, ortasını ulduzla əvəz edirik
        let modifiedWords = words.map(function(word) {
            let cleanWord = word.toLowerCase(); // Bütün sözləri kiçik hərflərlə yoxlayırıq
            if (wordsToMask.includes(cleanWord)) {
                return maskWord(word); // Əgər siyahıda varsa, ulduzla dəyişdiririk
            }
            return word; // Əks halda olduğu kimi saxlayırıq
        });

        let modifiedSentence = modifiedWords.join(' '); // Yenidən sözləri birləşdiririk
        document.getElementById('result').innerHTML = "Nəticə: " + modifiedSentence;
    }

    // Enter düyməsi basıldıqda prosesi işə salan funksiya
    document.getElementById('sentence').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Enter basıldıqda səhifənin yenilənməsini dayandırırıq
            processSentence(); // Cümləni dəyişdiririk
        }
    });
</script>
</body>
</html>
