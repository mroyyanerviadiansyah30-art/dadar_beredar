import json

with open('C:/Users/HP/.gemini/antigravity-ide/brain/fad13648-d098-427c-8098-c3f695bbe64f/.system_generated/logs/transcript.jsonl', 'r', encoding='utf-8') as f:
    for i, line in enumerate(f):
        data = json.loads(line)
        if data.get('type') == 'USER_INPUT' or 'USER' in data.get('source', ''):
            print(f"Step {data.get('step_index')}: {data.get('content')}\n---")
