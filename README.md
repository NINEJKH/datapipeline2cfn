[![Build Status](https://travis-ci.org/NINEJKH/datapipeline2cfn.svg?branch=master)](https://travis-ci.org/NINEJKH/datapipeline2cfn)

# datapipeline2cfn

A AWS DataPipeline (JSON export) to Cloudformation (PipelineObjects) converter

## Installation

```bash
$ curl -#fL "$(curl -s https://api.github.com/repos/NINEJKH/datapipeline2cfn/releases/latest | grep 'browser_download_url' | sed -n 's/.*"\(http.*\)".*/\1/p')" | sudo tee /usr/local/bin/datapipeline2cfn > /dev/null && sudo chmod +x /usr/local/bin/datapipeline2cfn
```

## Example

```bash
$ datapipeline2cfn convert dataPipeline.txt > pipelineObjects.yml
```
