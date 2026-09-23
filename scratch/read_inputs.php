<?php
$file = 'C:/Users/HP/.gemini/antigravity-ide/brain/fad13648-d098-427c-8098-c3f695bbe64f/.system_generated/logs/transcript.jsonl';
$lines = file($file);
foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (($data['type'] ?? '') === 'USER_INPUT' || str_contains($data['source'] ?? '', 'USER')) {
        echo "Step " . ($data['step_index'] ?? '') . ":\n" . ($data['content'] ?? '') . "\n-------------------------\n";
    }
}
