const fs = require('fs');

// Append origin data to manifest before clear
let originData = Mix.manifest.read();
for (let filePath in originData) {
    if (originData.hasOwnProperty(filePath) && fs.existsSync(path.join(Config.publicPath, filePath))) {
        Mix.manifest.add(originData[filePath]);
    }
}
